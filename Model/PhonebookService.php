<?php
App::uses('PhonebooksAppModel', 'Phonebooks.Model');
/**
 * Directory Model
 *
 */
class PhonebookService extends PhonebooksAppModel {
	
	public $name = 'PhonebookService';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'Service Name';
	
	public $useTable = 'phonebooks_services';
 	
	public $belongsTo = array(
		'Phonebook' => array(
			'className' => 'Phonebooks.Phonebook',
			'foreignKey' => 'phonebook_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
