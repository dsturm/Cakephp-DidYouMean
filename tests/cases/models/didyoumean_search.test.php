<?php
/* DidyoumeanSearch Test cases generated on: 2010-08-08 11:08:20 : 1281259100*/
App::import('Model', 'Didyoumean.DidyoumeanSearch');

class DidyoumeanSearchTestCase extends CakeTestCase {
	function startTest() {
		$this->DidyoumeanSearch =& ClassRegistry::init('DidyoumeanSearch');
	}

	function endTest() {
		unset($this->DidyoumeanSearch);
		ClassRegistry::flush();
	}

}
?>