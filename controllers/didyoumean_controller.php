<?php
class DidyoumeanController extends DidyoumeanAppController {

    var $name = 'Didyoumean';
    var $uses = array('Didyoumean.DidyoumeanSearch','Didyoumean.DidyoumeanDictionary','Didyoumean.DidyoumeanChoice','Didyoumean.DidyoumeanLanguage');

    function beforeFilter() {
        Configure::load('Didyoumean.didyoumean');
        parent::beforeFilter();
    }

    function index() {
    // @todo: Add you own security check!
        $this->redirect('/didyoumean/didyoumean_searches');
    }

    function search($string,$record = true) {

        if(Configure::read('Didyoumean.enabled') && $string != '') {
            $string = strtolower($string);
            if(Configure::read('language') != false){
                // look for application language
                $language = $this->DidyoumeanLanguage->findByName(Configure::read('language'));
            }else{
                // else use default language
                $language = $this->DidyoumeanLanguage->findByName(Configure::read('Didyoumean.language'));
            }
            // get the ID of the language
            $language_id = $language['DidyoumeanLanguage']['id'];

            if (file_exists(TMP . 'logs'.DS.'didyoumean.log')) {
                // delete log file
                unlink(TMP . 'logs'.DS.'didyoumean.log');
            }
            if($string != null) {
                // find search
                $search = $this->DidyoumeanSearch->find('first',array('conditions' => array('DidyoumeanSearch.string' => $string, 'DidyoumeanSearch.language_id' => $language_id)));
                if ($record == true) {
                    // check if exists
                    if(!empty($search)) {
                    // if yes: add 1 to count
                        $this->DidyoumeanSearch->updateAll(array('DidyoumeanSearch.count' => 'DidyoumeanSearch.count + 1'),array('DidyoumeanSearch.id' => $search['DidyoumeanSearch']['id']));
                    }else {
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
                //get did you mean
                $didyoumean = $this->DidyoumeanDictionary->didYouMean($string,$search['DidyoumeanSearch']['id']);
                return $didyoumean;
            }
            else {
            // no search string
                return false;
            }
        }else {
            return false;
        }

    }

    function suggestion() {
        if(Configure::read('Didyoumean.enabled')) {
        //!empty($this->params['url']['search_string']) ? $search_string = $this->params['url']['search_string'] : '';
            !empty($this->params['named']['suggestion_id']) ? $suggestion_id = $this->params['named']['suggestion_id'] : '';
            !empty($this->params['named']['search_id']) ? $search_id = $this->params['named']['search_id'] : '';
            !empty($this->params['named']['suggestion_string']) ? $suggestion_string = $this->params['named']['suggestion_string'] : '';
            // do some checks

            $conditions = array('DidyoumeanChoice.search_id' => $search_id,'DidyoumeanChoice.dictionary_id' => $suggestion_id);
            $choice = $this->DidyoumeanChoice->find('first',array('conditions' => $conditions));
            if(!empty($choice)) {
                $this->DidyoumeanChoice->updateAll(array('DidyoumeanChoice.count' => 'DidyoumeanChoice.count + 1'),$conditions);
            }else {
                $this->DidyoumeanChoice->create();
                $data = array();
                $data['DidyoumeanChoice']['search_id'] = $search_id;
                $data['DidyoumeanChoice']['count'] = 1;
                $data['DidyoumeanChoice']['dictionary_id'] = $suggestion_id;
                $this->DidyoumeanChoice->save($data);
            }
            $search_url = Configure::read('Didyoumean.search_url');
            $search_url = sprintf($search_url, $suggestion_string);
            $this->redirect($search_url);
            exit;
        }

    }

}
?>