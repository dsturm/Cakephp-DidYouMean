<?php
class DidyoumeanSearchesController extends DidyoumeanAppController {

    var $name = 'DidyoumeanSearches';

    function index() {
        $this->DidyoumeanSearch->recursive = 1;
        $didyoumeanSearches = $this->paginate();
        $this->loadModel('DidyoumeanDictionary');
       
        foreach ($didyoumeanSearches as &$search) {
            $word = $this->DidyoumeanDictionary->findByWord($search['DidyoumeanSearch']['string']);
            empty($word) ? $word = false : $word = true;
            $search['InDictionary'] = $word;
            $search['return'] = $this->requestAction('didyoumean/didyoumean/search/'.$search['DidyoumeanSearch']['string'].'/0');
        } 
        
        $this->set('didyoumeanSearches', $didyoumeanSearches);
    }

}
?>