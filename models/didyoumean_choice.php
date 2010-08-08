<?php
class DidyoumeanChoice extends DidyoumeanAppModel {
	var $name = 'DidyoumeanChoice';
	var $validate = array(
		'search_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'suggestion_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'count' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'DidyoumeanSearch' => array(
			'className' => 'Didyoumean.DidyoumeanSearch',
			'foreignKey' => 'search_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DidyoumeanDictionary' => array(
			'className' => 'Didyoumean.DidyoumeanDictionary',
			'foreignKey' => 'dictionary_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>