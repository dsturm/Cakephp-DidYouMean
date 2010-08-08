<?php
/* DidyoumeanChoice Fixture generated on: 2010-08-08 11:08:19 : 1281259099 */
class DidyoumeanChoiceFixture extends CakeTestFixture {
	var $name = 'DidyoumeanChoice';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'search_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'dictionary_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
                'count ' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'search_id' => 1,
                        'dictionary_id' => 1,
                        'count' => 1
		),
	);
}
?>