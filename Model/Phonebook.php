<?php
App::uses('PhonebooksAppModel', 'Phonebooks.Model');
/**
 * Directory Model
 *
 */
class Phonebook extends PhonebooksAppModel {
	
	public $name = 'Phonebook';
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	
	public $useTable = 'phonebooks';
        
 /**
  * Acts as
  * 
  * @var array
  */
    public $actsAs = array(
        'Tree', 
        'Galleries.Mediable' => array('modelAlias' => 'Phonebook'),
		);
 	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'phone' => array(
			'phone' => array(
				'rule' => array('phone'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public $belongsTo = array(
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Creator' => array(
			'className' => 'Users.User',
			'foreignKey' => 'creator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	public $hasMany = array(
        'PhonebookService' => array(
            'className' => 'Phonebooks.PhonebookService',
            'foreignKey' => 'phonebook_id',
            'conditions' => '',
            'order' => ''
        )
    );
	
	public function beforeSave($options = array()) {
	    if (empty($this->data['Phonebook']['user_id'])) {
	    	$this->data['Phonebook']['user_id'] = $this->userId;
	    }
    	return true;
	} 
	
	public function __construct($id = false, $table = null, $ds = null) {
		
		if(CakePlugin::loaded('Media')) {
			$this->actsAs[] = 'Media.MediaAttachable';
		}
		
		if(CakePlugin::loaded('Categories')) {
			$this->actsAs[] = 'Categories.Categorizable';
			$this->hasAndBelongsToMany['Category'] = array(
					'className' => 'Categories.Category',
					'foreignKey' => 'foreign_key',
					'associationForeignKey' => 'category_id',
					'with' => 'Categories.Categorized'
				);
		}
		if(CakePlugin::loaded('Ratings')) {
			$this->actsAs[] = 'Ratings.Ratable';
			$this->hasAndBelongsToMany['Ratings'] = array(
					'className' => 'Ratings.Rating',
					'foreignKey' => 'foreign_key',
					'associationForeignKey' => 'rate_id',
					'with' => 'Ratings.Rating'
				);
		}

		if(CakePlugin::loaded('Answers')) {
			$this->belongsTo['Answer'] = array(
		            'className' => 'Answers.Answer',
		            'foreignKey' => 'answer_id',
		            'type' => 'INNER',
		            'dependent' => false
		        );
		}
		parent::__construct($id = false, $table = null, $ds = null);
	}
}
