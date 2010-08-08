<?php
/* DidyoumeanDictionary Fixture generated on: 2010-08-08 11:08:19 : 1281259099 */
class DidyoumeanDictionaryFixture extends CakeTestFixture {
	var $name = 'DidyoumeanDictionary';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'word' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'language_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'word' => array('column' => 'word', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'word' => 'rolex',
			'language_id' => 1
		),
                array(
			'id' => 2,
			'word' => 'molex',
			'language_id' => 1
		),
                array(
			'id' => 3,
			'word' => 'development',
			'language_id' => 1
		),
                array(
			'id' => 4,
			'word' => 'webdevelopment',
			'language_id' => 1
		),
                array(
			'id' => 5,
			'word' => 'This is word 5',
			'language_id' => 1
		),

	);
}
?>