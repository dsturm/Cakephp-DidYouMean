<?php
/* DidyoumeanDictionaries Test cases generated on: 2010-08-07 11:08:18 : 1281174978*/
App::import('Controller', 'didyoumean.DidyoumeanDictionaries');

class TestDidyoumeanDictionariesController extends DidyoumeanDictionariesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DidyoumeanDictionariesControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->DidyoumeanDictionaries =& new TestDidyoumeanDictionariesController();
		$this->DidyoumeanDictionaries->constructClasses();
	}

	function endTest() {
		unset($this->DidyoumeanDictionaries);
		ClassRegistry::flush();
	}

}
?>