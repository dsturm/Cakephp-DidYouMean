<?php
/* DidyoumeanLanguage Test cases generated on: 2010-08-08 10:08:23 : 1281257843*/
App::import('Model', 'Didyoumean.DidyoumeanLanguage');

class DidyoumeanLanguageTestCase extends CakeTestCase {
	function startTest() {
		$this->DidyoumeanLanguage =& ClassRegistry::init('DidyoumeanLanguage');
	}

	function endTest() {
		unset($this->DidyoumeanLanguage);
		ClassRegistry::flush();
	}

}
?>