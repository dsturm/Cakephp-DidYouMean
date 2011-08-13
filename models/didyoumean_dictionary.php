<?php

class DidyoumeanDictionary extends DidyoumeanAppModel {

    var $name = 'DidyoumeanDictionary';
    var $validate = array(
        'word' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
        )
    );
    var $hasMany = array(
        'DidyoumeanChoice' => array(
            'className' => 'Didyoumean.DidyoumeanChoice',
            'foreignKey' => 'dictionary_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    var $belongsTo = array(
        'DidyoumeanLanguage' => array(
            'className' => 'DidyoumeanLanguage',
            'foreignKey' => 'language_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /*
     * @author Visti Kløft (hr.kloft@gmail.com)
     * @return array Returns an array with: all the words from the dictionary in the database
     */

    function getListOfWords() {
        $setting = ClassRegistry::init('Didyoumean.DidyoumeanSetting');
        if ($setting->get('language')) {
            $list = Cache::read('getListOfWords');
            if ($list !== false) {
                return $list;
            }
        }
        $this->recursive = 0;
        $words = $this->find('all');
        $result = array();
        foreach ($words as $word) {
            $result[$word['DidyoumeanDictionary']['id']] = $word['DidyoumeanDictionary']['word'];
        }
        if ($setting->get('use_cache')) {
            Cache::write('getListOfWords', $result);
        }
        return $result;
    }

    /*
     * @author Visti Kløft (hr.kloft@gmail.com)
     * @param string $search_string the search string to be searched for
     * @return array Returns an array with: related words from the DB (using LIKE %% to find them)
     */

    function getRelatedWords($search_string) {
        $setting = ClassRegistry::init('Didyoumean.DidyoumeanSetting');
        if ($setting->get('get_related_words')) {
            $this->writelog('started: ' . __FUNCTION__ . ' with: ' . print_r(func_get_args(), true), 'didyoumean');
            if ($setting->get('use_cache')) {
                $list = Cache::read('getWordsContaining_' . $search_string);
                if ($list !== false) {
                    $this->writelog('ended: ' . __FUNCTION__ . ' with: ' . print_r($link, true), 'didyoumean');
                    return $list;
                }
            }
            $words = $this->find('all',
                            array('conditions' => array(
                                    "AND" => array(
                                        'DidyoumeanDictionary.word LIKE' => "%$search_string%",
                                        'DidyoumeanDictionary.word !=' => "$search_string"))));
            $result = array();
            foreach ($words as $word) {
                $result[] = $word['DidyoumeanDictionary']['word'];
            }
            if ($setting->get('use_cache')) {
                Cache::write('getWordsContaining_' . $search_string, $result);
            }
            $this->writelog('ended: ' . __FUNCTION__ . ' with: ' . print_r($result, true), 'didyoumean');
            return $result;
        }
    }

    /*
     * @author Visti Kløft (hr.kloft@gmail.com)
     * @param string $search_string the search string to be searched for
     * @param int $search_id the id of the search in the db
     * @return array Returns an array with: user choices of that word, exact match and close matches to the search string
     */

    function didYouMean($search_string, $search_id) {
        $setting = ClassRegistry::init('Didyoumean.DidyoumeanSetting');
        //write log (only if debug == true)
        $this->writelog('started: ' . __FUNCTION__ . ' with: ' . print_r(func_get_args(), true), 'didyoumean');
        // check for cache (only if use_cache == true)
        $search_string = strtolower($search_string);
        if ($setting->get('use_cache')) {
            $list = Cache::read('didYouMean_' . $search_string, 'didyoumean');
            if ($list !== false) {
                $this->writelog('ended: (returned cache): ' . __FUNCTION__ . ' with: ' . print_r($list, true), 'didyoumean');
                return $list;
            }
        }
        // get list of word from the DB
        $words = $this->getListOfWords();
        $result = array();
        // get user choices
        $choices = $this->DidyoumeanChoice->find('all', array('conditions' => array('search_id' => $search_id), 'order' => 'DidyoumeanChoice.count desc'));
        // check if any user choices
        if (!empty($choices)) {
            // get minimum percentage & minimum count
            $minimum_user_choice_percentage = $setting->get('minimum_user_choice_percentage');
            $minimum_user_choice_count = $setting->get('minimum_user_choice_count');
            $this->writelog('got following choices: ' . print_r($choices, true), 'didyoumean');
            // foreach choice check if the choice should be added to the output
            foreach ($choices as $key => $choice) {

                $percentage = $choice['DidyoumeanChoice']['count'] / $choice['DidyoumeanSearch']['count'] * 100;
                // if conditions from config file is true added to the output
                if ($minimum_user_choice_percentage < $percentage &&
                        $minimum_user_choice_count < $choice['DidyoumeanChoice']['count']) {

                    $word = $choice['DidyoumeanDictionary']['word'];
                    $suggestion_id = $choice['DidyoumeanDictionary']['id'];
                    $data = array();
                    $data['type'] = 'users';
                    $data['count'] = $choice['DidyoumeanChoice']['count'];
                    $data['search_count'] = $choice['DidyoumeanSearch']['count'];
                    $data['percentage'] = $percentage;
                    $data['search_string'] = $search_string;
                    $data['search_id'] = $search_id;
                    $data['suggestion_string'] = $word;
                    $data['suggestion_id'] = $suggestion_id;
                    $data['text'] = $setting->getText();
                    $result[] = $data;
                }
            }
        }
        // each each word in the DB for close or exact match
        foreach ($words as $key => $word) {
            // calculate the distance between the input word and the current word
            // change these to edit levenshtein parameters
            // check: http://php.net/manual/en/function.levenshtein.php
            $cost_ins = 1;
            $cost_rep = 1;
            $cost_del = 1;
            // get the levenshtein distance
            $lev = levenshtein($search_string, $word, $cost_ins, $cost_rep, $cost_del);
            // get the levenshtein distance in percentage
            $lev_percent = $lev / strlen($word) * 100;
            // get the maxium deviation for the word
            $devitation = $this->getMaxDeviation($search_string);
            // check for an exact match
            if ($lev == 0) {
                $suggestions = $this->getRelatedWords($word);
                $data = array();
                $data['type'] = 'match';
                $data['search_string'] = $search_string;
                $data['search_id'] = $search_id;
                $data['suggestion_string'] = $word;
                $data['deviation'] = $lev_percent;
                $data['max_devitation'] = $devitation;
                $data['suggestion_id'] = $key;
                $data['related'] = $suggestions;
                $data['text'] = $setting->getText();
                $result[] = $data;
                $this->writelog('got exact match: ' . print_r($data, true), 'didyoumean');
            }
            // check if it's a close match (within maxDeviation) and NOT an exact match
            if ($lev_percent <= $devitation && $lev != 0) {
                $suggestions = $this->getRelatedWords($word);
                $data = array();
                $data['type'] = 'close match';
                $data['search_string'] = $search_string;
                $data['search_id'] = $search_id;
                $data['suggestion_string'] = $word;
                $data['deviation'] = $lev_percent;
                $data['max_devitation'] = $devitation;
                $data['suggestion_id'] = $key;
                $data['related'] = $suggestions;
                $data['text'] = $setting->getText();
                $result[] = $data;
                $this->writelog('got close match: ' . print_r($data, true), 'didyoumean');
            }
        }
        // if cache enabled: write it
        if ($setting->get('use_cache')) {
            Cache::write('didYouMean_' . $search_string, $result, 'didyoumean');
            $this->writelog('wrote cache:' . print_r($result, true), 'didyoumean');
        }
        // log it if debug is enabled
        $this->writelog('ended: ' . __FUNCTION__ . ' returned: ' . print_r($result, true), 'didyoumean');
        if (empty($result) && $setting->get('help')) {
            $this->log('"' . $search_string . '" did not return any suggestions. Maybe you should add some?', 'didyoumean_help');
        }
        return $result;
    }

    /*
     * @author Visti Kløft (hr.kloft@gmail.com)
     * @param string $search_string the search string to be searched for
     * @return int Returns an int with the max deviation in percent
     */

    function getMaxDeviation($search_string) {
        $lenght = strlen($search_string);
        switch ($lenght) {
            case 1:
                $return = 0;
                break;

            case 2:
                $return = 50;
                break;

            case 3:
                $return = 34;
                break;

            default:
                $return = 25;
                break;
        }
        return $return;
    }

    /*
     * @author Visti Kløft (hr.kloft@gmail.com)
     * @param string $msg the message to be logged
     * @param string $type the type of the message
     */

    function writeLog($msg, $type = null) {
        $setting = ClassRegistry::init('Didyoumean.DidyoumeanSetting');
        // if debug is enabled write the log
        if ($setting->get('debug')) {
            $this->log($msg, $type);
        }
    }

}

?>