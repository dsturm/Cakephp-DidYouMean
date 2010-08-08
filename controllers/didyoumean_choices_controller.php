<?php
class DidyoumeanChoicesController extends DidyoumeanAppController {

	var $name = 'DidyoumeanChoices';

	function index() {
		$this->DidyoumeanChoice->recursive = 0;
		$this->set('didyoumeanChoices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid didyoumean choice', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('didyoumeanChoice', $this->DidyoumeanChoice->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DidyoumeanChoice->create();
			if ($this->DidyoumeanChoice->save($this->data)) {
				$this->Session->setFlash(__('The didyoumean choice has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The didyoumean choice could not be saved. Please, try again.', true));
			}
		}
		$didyoumeanSearches = $this->DidyoumeanChoice->DidyoumeanSearch->find('list');
		$didyoumeanDictionaries = $this->DidyoumeanChoice->DidyoumeanDictionary->find('list');
		$this->set(compact('didyoumeanSearches', 'didyoumeanDictionaries'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid didyoumean choice', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DidyoumeanChoice->save($this->data)) {
				$this->Session->setFlash(__('The didyoumean choice has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The didyoumean choice could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DidyoumeanChoice->read(null, $id);
		}
		$didyoumeanSearches = $this->DidyoumeanChoice->DidyoumeanSearch->find('list');
		$didyoumeanDictionaries = $this->DidyoumeanChoice->DidyoumeanDictionary->find('list');
		$this->set(compact('didyoumeanSearches', 'didyoumeanDictionaries'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for didyoumean choice', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DidyoumeanChoice->delete($id)) {
			$this->Session->setFlash(__('Didyoumean choice deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Didyoumean choice was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>