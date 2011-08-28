<?php
/* DidyoumeanLanguage Fixture generated on: 
Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'Europe/Berlin' for 'CEST/2.0/DST' instead in /Applications/XAMPP/xamppfiles/htdocs/didyoumean_cleancake_dev/cake/console/templates/default/classes/fixture.ctp on line 24
2011-08-27 18:18:28 : 1314461908 */
class DidyoumeanLanguageFixture extends CakeTestFixture {
	var $name = 'DidyoumeanLanguage';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'eng'
		),
		array(
			'id' => 2,
			'name' => 'fra'
		),
		array(
			'id' => 3,
			'name' => 'spa'
		),
		array(
			'id' => 4,
			'name' => 'dan'
		),
		array(
			'id' => 5,
			'name' => 'ita'
		),
		array(
			'id' => 6,
			'name' => 'ger'
		),
	);
}
?>