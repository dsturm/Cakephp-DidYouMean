<?php
/* DidyoumeanSearches Test cases generated on: 2010-08-07 11:08:47 : 1281174767*/
App::import('Controller', 'didyoumean.DidyoumeanSearches');

class TestDidyoumeanSearchesController extends DidyoumeanSearchesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DidyoumeanSearchesControllerTestCase extends CakeTestCase {
	var $fixtures = array('');

	function startTest() {
		$this->DidyoumeanSearches =& new TestDidyoumeanSearchesController();
		$this->DidyoumeanSearches->constructClasses();
	}

	function endTest() {
		unset($this->DidyoumeanSearches);
		ClassRegistry::flush();
	}

}
?>