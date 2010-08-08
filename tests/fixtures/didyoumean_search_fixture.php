<?php
/* DidyoumeanSearch Fixture generated on: 2010-08-08 11:08:19 : 1281259099 */
class DidyoumeanSearchFixture extends CakeTestFixture {
	var $name = 'DidyoumeanSearch';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'string' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'count' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'language_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'string' => array('column' => 'string', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'string' => 'Lorem ipsum dolor sit amet',
			'count' => 1,
			'language_id' => 1
		),
	);
}
?>