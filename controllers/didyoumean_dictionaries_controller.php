<?php

class DidyoumeanDictionariesController extends DidyoumeanAppController {

    var $name = 'DidyoumeanDictionaries';

    function admin_index() {
        $this->DidyoumeanDictionary->recursive = 0;
        $this->set('didyoumeanDictionaries', $this->paginate());
    }

    function admin_addWord($word = null) {
        if ($word != null) {
            $this->DidyoumeanDictionary->create();
            $data['DidyoumeanDictionary']['word'] = trim(strtolower($word));
            if ($this->DidyoumeanDictionary->save($data)) {
                $this->Session->setFlash(__("Word saved", true));
            } else {
                $this->Session->setFlash(__("Could not save the word", true));
            }
        }
        $this->redirect($this->referer());
    }

    function admin_import() {
        if (!empty($this->data)) {
            //pr($this->data);
            $import_data = explode($this->data['DidyoumeanDictionary']['seperator'], $this->data['DidyoumeanDictionary']['input']);

            $import_data = array_unique($import_data);

            //pr($import_data);
            $imported = 0;
            $skipped = 0;
            $failed = 0;
            foreach ($import_data as $word) {
                $data = array();
                $exists = $this->DidyoumeanDictionary->findByWord($word);
                if ($word != '' && empty($exists)) {
                    $this->DidyoumeanDictionary->create();
                    $data['DidyoumeanDictionary']['word'] = trim(strtolower($word));
                    if ($this->DidyoumeanDictionary->save($data)) {
                        $imported++;
                    } else {
                        $failed++;
                    }
                } else {
                    $skipped++;
                }
            }
            $this->Session->setFlash(__("Status:<br>imported:$imported<br>skipped:$skipped<br>failed:$failed", true));
        }
    }

    function admin_magicimport() {
        App::import('Model', 'Node');
        $this->Node->recursive = 0;
        $nodes = $this->Node->find('all', array(
                    'fields' => array('Node.body', 'Node.title')
                ));
        
        $output = array();
        foreach ($nodes as $node) {
            $body = $node['Node']['body'];
            $title = $node['Node']['title'];

            $body = split(" ", $body);
            $title = split(" ", $title);
            $words = array_merge($body,$title);
            $i = 0;
            foreach ($words as $word) {
                $word = strip_tags($word);
                $word = str_replace(array(".",",","\n"), "", $word);
                $word = strtolower($word);
                $exist = $this->DidyoumeanDictionary->findByWord($word);
                if (empty($exist)){
                    $i++;
                    $data = array();
                    $this->DidyoumeanDictionary->create();
                    $data['DidyoumeanDictionary']['word'] = $word;
                    $data['DidyoumeanDictionary']['language_id'] = 1;
                    $this->DidyoumeanDictionary->save($data);
                }
            }
        }
        // TODO: Delete cache files
        $this->Session->setFlash(__("$i new words imported", true));
        $this->redirect($this->referer());
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->DidyoumeanDictionary->create();
            if ($this->DidyoumeanDictionary->save($this->data)) {
                $this->Session->setFlash(__('The didyoumean dictionary has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The didyoumean dictionary could not be saved. Please, try again.', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid didyoumean dictionary', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->DidyoumeanDictionary->save($this->data)) {
                $this->Session->setFlash(__('The didyoumean dictionary has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The didyoumean dictionary could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->DidyoumeanDictionary->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for didyoumean dictionary', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->DidyoumeanDictionary->delete($id)) {
            $this->Session->setFlash(__('Didyoumean dictionary deleted', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Didyoumean dictionary was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

}

?>