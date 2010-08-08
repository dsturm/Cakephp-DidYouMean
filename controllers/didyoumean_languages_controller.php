<?php
class DidyoumeanLanguagesController extends DidyoumeanAppController {

	var $name = 'DidyoumeanLanguages';

	function index() {
		$this->DidyoumeanLanguage->recursive = 0;
		$this->set('didyoumeanLanguages', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid didyoumean language', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('didyoumeanLanguage', $this->DidyoumeanLanguage->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DidyoumeanLanguage->create();
			if ($this->DidyoumeanLanguage->save($this->data)) {
				$this->Session->setFlash(__('The didyoumean language has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The didyoumean language could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid didyoumean language', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DidyoumeanLanguage->save($this->data)) {
				$this->Session->setFlash(__('The didyoumean language has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The didyoumean language could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DidyoumeanLanguage->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for didyoumean language', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DidyoumeanLanguage->delete($id)) {
			$this->Session->setFlash(__('Didyoumean language deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Didyoumean language was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>