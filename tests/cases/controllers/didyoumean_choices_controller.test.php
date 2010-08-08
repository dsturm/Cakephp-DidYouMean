<?php
/* DidyoumeanChoices Test cases generated on: 2010-08-07 11:08:16 : 1281174916*/
App::import('Controller', 'didyoumean.DidyoumeanChoices');

class TestDidyoumeanChoicesController extends DidyoumeanChoicesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DidyoumeanChoicesControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->DidyoumeanChoices =& new TestDidyoumeanChoicesController();
		$this->DidyoumeanChoices->constructClasses();
	}

	function endTest() {
		unset($this->DidyoumeanChoices);
		ClassRegistry::flush();
	}

}
?>