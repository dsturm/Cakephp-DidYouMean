<?php
/* DidyoumeanSetting Fixture generated on: 
Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'Europe/Berlin' for 'CEST/2.0/DST' instead in /Applications/XAMPP/xamppfiles/htdocs/didyoumean_cleancake_dev/cake/console/templates/default/classes/fixture.ctp on line 24
2011-08-27 18:06:05 : 1314461165 */
class DidyoumeanSettingFixture extends CakeTestFixture {
	var $name = 'DidyoumeanSetting';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'enabled',
			'description' => 'enable the didyoumean plugin. Values: true / false',
			'value' => '1',
			'type' => 'boolean'
		),
		array(
			'id' => 2,
			'name' => 'debug',
			'description' => 'write log when running. Values: true / false',
			'value' => '1',
			'type' => 'boolean'
		),
		array(
			'id' => 3,
			'name' => 'get_related_words',
			'description' => 'will return related word to the search word if enabled. Values: true / false',
			'value' => '0',
			'type' => 'boolean'
		),
		array(
			'id' => 4,
			'name' => 'use_cache',
			'description' => 'use cache in some of the function. Values: true / false',
			'value' => '0',
			'type' => 'boolean'
		),
		array(
			'id' => 5,
			'name' => 'search_url',
			'description' => 'the url where to redirect after the suggestion function. Values: any string %s will be replaced by the search string',
			'value' => '/search/q:%s',
			'type' => 'text'
		),
		array(
			'id' => 6,
			'name' => 'minimum_user_choice_count',
			'description' => 'the minimum number of choices a suggestion should have before its shown. Values false / any positive integer',
			'value' => '0',
			'type' => 'int'
		),
		array(
			'id' => 7,
			'name' => 'minimum_user_choice_percentage',
			'description' => 'the minimum percentage (user choices / search on this word) of choices a suggestion should have before its shown. Values false / any positive integer <= 100',
			'value' => '0',
			'type' => 'int'
		),
		array(
			'id' => 8,
			'name' => 'help',
			'description' => 'Write to a log file if a search does not return any suggestions?. Values true / false',
			'value' => '1',
			'type' => 'boolean'
		),
		array(
			'id' => 9,
			'name' => 'language',
			'description' => 'Default language when Configure::read(language) returns false',
			'value' => 'eng',
			'type' => 'text'
		),
		array(
			'id' => 10,
			'name' => 'text_eng',
			'description' => 'The didyoumean text when suggesting new search in english',
			'value' => 'Did you mean \"%s\"?',
			'type' => 'text'
		),
		array(
			'id' => 12,
			'name' => 'text_dan',
			'description' => 'The didyoumean text when suggesting new search in danish',
			'value' => 'Mente du \"%s\"?',
			'type' => 'text'
		),
		array(
			'id' => 13,
			'name' => 'text_ger',
			'description' => 'The didyoumean text when suggesting new search in german',
			'value' => 'Meinten Sie \"%s\"?',
			'type' => 'text'
		),
		array(
			'id' => 14,
			'name' => 'text_fra',
			'description' => 'The didyoumean text when suggesting new search in french',
			'value' => 'Vouliez-vous dire \"s%\"?',
			'type' => 'text'
		),
		array(
			'id' => 15,
			'name' => 'text_ita',
			'description' => 'The didyoumean text when suggesting new search in italian',
			'value' => 'Forse cercavi \"s%\"?',
			'type' => 'text'
		),
		array(
			'id' => 16,
			'name' => 'text_spa',
			'description' => 'The didyoumean text when suggesting new search in spanish',
			'value' => 'A qué te referías \"%s\"?',
			'type' => 'text'
		),
	);
}
?>