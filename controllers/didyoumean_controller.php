<?php

class DidyoumeanController extends DidyoumeanAppController {

    var $name = 'Didyoumean';
    var $uses = array(
        'Didyoumean.DidyoumeanSearch',
        'Didyoumean.DidyoumeanDictionary',
        'Didyoumean.DidyoumeanChoice',
        'Didyoumean.DidyoumeanLanguage',
        'Didyoumean.DidyoumeanSetting');
    var $helpers = array('xml');

    function beforeFilter() {
        $this->Auth->Allow(array('search', 'suggestion'));
        parent::beforeFilter();
    }

    function admin_index() {
        // @todo: Add you own security check!
        $this->redirect('/admin/didyoumean/didyoumean/settings');
    }

    function search($string, $record = true) {
        if ($this->DidyoumeanSetting->get('enabled') && $string != '') {
            $string = strtolower($string);

            $language_id = $this->getLanguageId();

            if (file_exists(TMP . 'logs' . DS . 'didyoumean.log')) {
                // delete log file
                unlink(TMP . 'logs' . DS . 'didyoumean.log');
            }
            if ($string != null) {
                // find search
                $search = $this->DidyoumeanSearch->find('first', array('conditions' => array('DidyoumeanSearch.string' => $string, 'DidyoumeanSearch.language_id' => $language_id)));
                if ($record == true) {
                    // check if exists
                    if (!empty($search)) {
                        // if yes: add 1 to count
                        $this->DidyoumeanSearch->updateAll(array('DidyoumeanSearch.count' => 'DidyoumeanSearch.count + 1'), array('DidyoumeanSearch.id' => $search['DidyoumeanSearch']['id']));
                    } else {
                        //else create a new search
                        $this->DidyoumeanSearch->create();
                        $data = array();
                        $data['DidyoumeanSearch']['string'] = $string;
                        $data['DidyoumeanSearch']['count'] = 1;
                        $data['DidyoumeanSearch']['language_id'] = $language_id;
                        $this->DidyoumeanSearch->save($data);
                        $search['DidyoumeanSearch']['id'] = $this->DidyoumeanSearch->id;
                    }
                }
                $splitted = split(" ", $string);
                // if only one word, do the usual stuff
                if (count($splitted) == 1) {
                    //get did you mean
                    $didyoumean = $this->DidyoumeanDictionary->didYouMean($string, $search['DidyoumeanSearch']['id']);
                    return $didyoumean;
                    // if more then one word call didyoumean function on each
                } elseif (count($splitted) > 1) {
                    $output = array();
                    foreach ($splitted as $word) {
                        $didyoumean = $this->DidyoumeanDictionary->didYouMean($word, $search['DidyoumeanSearch']['id']);
                        if (empty($didyoumean)){
                            return false;
                        }
                        $o = array();
                        foreach ($didyoumean as $d) {
                            if ($d['suggestion_string'] != "" && $d['suggestion_string'] != " "){
                                $o[] = $d['suggestion_string'];
                            }
                        }

                        $output[] = $o;
                    }
                    return $this->combinations($output, $search['DidyoumeanSearch']['id'], $string);
                }
            } else {
                // no search string
                return false;
            }
        } else {
            return false;
        }
    }

    function combinations($didyoumean, $search_id, $string) {

        $iter = 0;
        $suggestions = array();
        // nice function found on the internet :)  return combinations as I need them
        while (1) {
            $num = $iter++;
            $pick = array();

            foreach ($didyoumean as $refineGroup => $groupValues) {
                $r = $num % count($groupValues);
                $num = ($num - $r) / count($groupValues);
                $pick[] = $groupValues[$r];

            }

            if ($num > 0) {
                break;
            }
            // create the suggestions as they should be structured, but only if search-string != suggestion
            if ($string != join(" ", $pick)) {
                $suggestions[$iter]['suggestion_string'] = join(" ", $pick);
                $suggestions[$iter]['search_id'] = $search_id;
                $suggestions[$iter]['type'] = "combined suggestion";
                $suggestions[$iter]['text'] = $this->DidyoumeanSetting->getText();

            }
        }
        //pr($suggestions);
        return $suggestions;
    }

    private function getLanguageId() {
        if ($this->DidyoumeanSetting->get('language') == false) {
            if ($this->isCroogoInstalled()){
                App::import('Model','Setting');
                $lang = $this->Setting->findByKey('Site.locale');
            }else{
                $this->cakeError('languageNotDefined');
            }
            // look for application language
            $language = $this->DidyoumeanLanguage->findByName($lang['Setting']['value']);
        } else {
            // else use default language
            $language = $this->DidyoumeanLanguage->findByName($this->DidyoumeanSetting->get('language'));
        }

        // get the ID of the language
        $language_id = $language['DidyoumeanLanguage']['id'];
        return $language_id;
    }

    function getXML($string) {
        Configure::write('debug', 0);
        $this->layout = null;
        $output = $this->search($string);
        $this->set('output', $output);
    }

    function suggestion() {
        if ($this->DidyoumeanSetting->get('enabled')) {
            //!empty($this->params['url']['search_string']) ? $search_string = $this->params['url']['search_string'] : '';
            !empty($this->params['named']['suggestion_id']) ? $suggestion_id = $this->params['named']['suggestion_id'] : '';
            !empty($this->params['named']['search_id']) ? $search_id = $this->params['named']['search_id'] : '';
            !empty($this->params['named']['suggestion_string']) ? $suggestion_string = $this->params['named']['suggestion_string'] : '';
            // do some checks

            if (empty($this->params['named']['suggestion_id'])) {
                $this->DidyoumeanSearch->create();
                $data = array();
                $data['DidyoumeanSearch']['string'] = $suggestion_string;
                $data['DidyoumeanSearch']['count'] = 1;
                $data['DidyoumeanSearch']['language_id'] = $this->getLanguageId();
                $this->DidyoumeanSearch->save($data);
                $suggestion_id = $this->DidyoumeanSearch->id;
            }
            $conditions = array('DidyoumeanChoice.search_id' => $search_id, 'DidyoumeanChoice.dictionary_id' => $suggestion_id);
            $choice = $this->DidyoumeanChoice->find('first', array('conditions' => $conditions));
            if (!empty($choice)) {
                $this->DidyoumeanChoice->updateAll(array('DidyoumeanChoice.count' => 'DidyoumeanChoice.count + 1'), $conditions);
            } else {
                $this->DidyoumeanChoice->create();
                $data = array();
                $data['DidyoumeanChoice']['search_id'] = $search_id;
                $data['DidyoumeanChoice']['count'] = 1;
                $data['DidyoumeanChoice']['dictionary_id'] = $suggestion_id;
                $this->DidyoumeanChoice->save($data);
            }
            $search_url = $this->DidyoumeanSetting->get('search_url');
            $search_url = sprintf($search_url, $suggestion_string);
            $this->redirect($search_url);
            exit;
        }
    }

    function admin_settings() {
        $this->set('title_for_layout', __('Did you mean settings', true));
        $this->set('settings', $this->DidyoumeanSetting->find('all'));
        $this->set('search_count', $this->DidyoumeanSearch->find('count'));
        $this->set('word_count', $this->DidyoumeanDictionary->find('count'));


    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid didyoumean setting', true));
            $this->redirect(array('action' => 'settings'));
        }
        if (!empty($this->data)) {
            if ($this->DidyoumeanSetting->save($this->data)) {
                $this->Session->setFlash(__('The didyoumean setting has been saved', true));
                $this->redirect(array('action' => 'settings'));
            } else {
                $this->data = $this->DidyoumeanSetting->read(null, $id);
                $this->set($this->data);
                $this->Session->setFlash(__('The didyoumean setting could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->DidyoumeanSetting->read(null, $id);
            $this->set($this->data);
        }
    }
}

?>