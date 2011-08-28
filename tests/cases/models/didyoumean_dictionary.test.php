<?php

/* DidyoumeanDictionary Test cases generated on: 2010-08-08 10:08:23 : 1281257843 */
App::import('Model', 'Didyoumean.DidyoumeanDictionary');

class DidyoumeanDictionaryTestCase extends CakeTestCase {

    var $fixtures = array(
        'plugin.didyoumean.didyoumean_dictionary',
        'plugin.didyoumean.didyoumean_language',
        'plugin.didyoumean.didyoumean_choice',
        'plugin.didyoumean.didyoumean_search',
        'plugin.didyoumean.didyoumean_setting'
    );

    function startTest() {
        $this->DidyoumeanDictionary = & ClassRegistry::init('DidyoumeanDictionary');
        Configure::load('Didyoumean.didyoumean_test');
    }

    function testgetListOfWords() {

        $result = $this->DidyoumeanDictionary->getListOfWords();
        $expected[1] = 'rolex';
        $expected[2] = 'molex';
        $expected[3] = 'development';
        $expected[4] = 'webdevelopment';
        $expected[5] = 'This is word 5';

        $this->assertEqual($result, $expected);
    }

    function testgetRelatedWords() {
    /*
        $expected = array();
        $expected[0] = 'rolex';
        $expected[1] = 'molex';
        $this->assertEqual($result, $expected, 'Words containing "lex": ');


        $result = $this->DidyoumeanDictionary->getRelatedWords('develop');
        $expected = array();
        $expected[0] = 'development';
        $expected[1] = 'webdevelopment';
        $this->assertEqual($result, $expected, 'Words containing "develop":');

        $result = $this->DidyoumeanDictionary->getRelatedWords('word 5');
        $expected = array();
        $expected[0] = 'This is word 5';
        $this->assertEqual($result, $expected, 'Words containing word 5: ');
        */

    }

    function testdidYouMean() {
        $result = $this->DidyoumeanDictionary->didYouMean('molex', '1');
        $expected[0]['type'] = 'users';
        $expected[0]['count'] = 1;
        $expected[0]['search_count'] = 1;
        $expected[0]['percentage'] = 100;
        $expected[0]['search_string'] = 'molex';
        $expected[0]['search_id'] = 1;
        $expected[0]['suggestion_string'] = 'rolex';
        $expected[0]['suggestion_id'] = 1;
        $expected[0]['text'] = 'Did you mean \"%s\"?';

        $expected[1]['type'] = 'close match';
        $expected[1]['search_string'] = 'molex';
        $expected[1]['search_id'] = 1;
        $expected[1]['suggestion_string'] = 'rolex';
        $expected[1]['deviation'] = 20;
        $expected[1]['max_devitation'] = 25;
        $expected[1]['suggestion_id'] = 1;
        $expected[1]['related'] = array();
        $expected[1]['text'] = 'Did you mean \"%s\"?';

        $expected[2]['type'] = 'match';
        $expected[2]['search_string'] = 'molex';
        $expected[2]['search_id'] = 1;
        $expected[2]['suggestion_string'] = 'molex';
        $expected[2]['deviation'] = 0;
        $expected[2]['max_devitation'] = 25;
        $expected[2]['suggestion_id'] = 2;
        $expected[2]['related'] = array();
        $expected[2]['text'] = 'Did you mean \"%s\"?';

        //debug($result);
        $index = 0;
        foreach ($result as $r) {
            $this->assertEqual($r, $expected[$index], 'Type = ' . $expected[$index]['type']);
            $index++;
        }
    }

    function testGetMaxDeviation() {
        $words = array('a', 'aa', 'aaa', 'aaaa', 'aaaaaaa');
        $maxDeviation = array(0, 50, 34, 25, 25);
        $index = 0;
        foreach ($words as $word) {
            $result = $this->DidyoumeanDictionary->getMaxDeviation($word);
            $this->assertEqual($result, $maxDeviation[$index], 'Length = ' . strlen($word));
            $index++;
        }
    }

    function endTest() {
        unset($this->DidyoumeanDictionary);
        ClassRegistry::flush();
    }

}

?>