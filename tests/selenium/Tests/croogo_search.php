<?php

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class Croogo_Search extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost/didyoumean_croogo/");
  }

  public function testMyTestCase()
  {
    $this->open("search/q:velcome");
    for ($second = 0; ; $second++) {
        if ($second >= 60) $this->fail("timeout");
        try {
            if ($this->isTextPresent('Did you mean "welcome"?')) break;
        } catch (Exception $e) {}
        sleep(1);
    }

    try {
        $this->assertTrue($this->isTextPresent('Did you mean "welcome"?'));
    } catch (PHPUnit_Framework_AssertionFailedError $e) {
        array_push($this->verificationErrors, $e->toString());
    }
  }
}
?>