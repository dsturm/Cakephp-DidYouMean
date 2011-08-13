<?php
class DidyoumeanSearchesController extends DidyoumeanAppController {

    var $name = 'DidyoumeanSearches';

    function admin_index() {
        $this->DidyoumeanSearch->recursive = 1;
        $didyoumeanSearches = $this->paginate();
        /*
        $this->loadModel('DidyoumeanDictionary');
        App::import('Controller', 'Didyoumean.Didyoumean');
        $this->Didyoumean =& new DidyoumeanController();
        
        foreach ($didyoumeanSearches as &$search) {
            $word = $this->DidyoumeanDictionary->findByWord($search['DidyoumeanSearch']['string']);
            empty($word) ? $word = false : $word = true;
            $search['InDictionary'] = $word;
            //$search['return'] = $this->requestAction('/didyoumean/search/'.$search['DidyoumeanSearch']['string'].'/0');
            //$search['return'] = $this->requestAction('didyoumean/didyoumean/search/' . $q . "/0");
            $search['return']  = $this->Didyoumean->search($search['DidyoumeanSearch']['string'], false);
        } 
        */
        $this->set('didyoumeanSearches', $didyoumeanSearches);
    }

}
?>