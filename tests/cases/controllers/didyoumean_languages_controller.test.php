<?php
/* DidyoumeanLanguages Test cases generated on: 2010-08-08 11:08:07 : 1281258187*/
App::import('Controller', 'Didyoumean.DidyoumeanLanguages');

class TestDidyoumeanLanguagesController extends DidyoumeanLanguagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DidyoumeanLanguagesControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->DidyoumeanLanguages =& new TestDidyoumeanLanguagesController();
		$this->DidyoumeanLanguages->constructClasses();
	}

	function endTest() {
		unset($this->DidyoumeanLanguages);
		ClassRegistry::flush();
	}

}
?>