<?php
App::uses('PhonebooksAppController', 'Phonebooks.Controller');
/**
 * Directories Controller
 *
 * @property Phonebook $Phonebook
 */
class AppPhonebooksController extends PhonebooksAppController {

/**
 * Helpers
 *
 * @var array
 */
	//public $helpers = array('Media');
	
	public $uses = 'Phonebooks.Phonebook';

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Phonebook->recursive = 0;
		$this->paginate['contain'][] = 'PhonebookService';
		if(CakePlugin::loaded('Categories')) {
			$this->paginate['contain'][] = 'Category';
			if(isset($this->request->query['categories'])) {
				$categoriesParam = explode(';', rawurldecode($this->request->query['categories']));
				$this->set('selected_categories', json_encode($categoriesParam));
				$joins = array(
		           array('table'=>'categorized', 
		                 'alias' => 'Categorized',
		                 'type'=>'left',
		                 'conditions'=> array(
		                 	'Categorized.foreign_key = Phonebook.id'
		           )),
		           array('table'=>'categories', 
		                 'alias' => 'Category',
		                 'type'=>'left',
		                 'conditions'=> array(
		                 	'Category.id = Categorized.category_id'
				   ))
		         );
				$this->paginate['joins'] = $joins;
				$this->paginate['conditions'] = array('Category.name' => $categoriesParam);
				$this->paginate['fields'] = array(
					'DISTINCT Phonebook.id', 
					'Phonebook.name', 
					'Phonebook.address_1', 
					'Phonebook.address_2',
					'Phonebook.city',
					'Phonebook.state',
					'Phonebook.zip', 
					'Phonebook.phone',
					'Phonebook.email',
					'Phonebook.website'
				);
			}
		}
		$this->set('phonebooks', $this->paginate());
		
		$conditions = !empty($categoriesParam) ? array('Category.model' => 'Phonebook', 'Category.name' => $categoriesParam) : array('Category.model' => 'Phonebook', 'Category.parent_id' => null);
		$contain = !empty($categoriesParam) ? array('ChildCategory' => array('ChildCategory')) : array(); 
		$this->set('categories', $this->Phonebook->Category->find('all', array('conditions' => $conditions, 'contain' => $contain)));
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		
		if (!$this->Phonebook->exists($id)) {
			throw new NotFoundException(__('Invalid Phonebook'));
		}
		
		$this->set('phonebook', $this->Phonebook->find('first', array(
			'conditions' => array('Phonebook.id' => $id),
			'contain' => array('Category', 'PhonebookService'),
			)));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {		
		if ($this->request->is('post')) {
			$this->Phonebook->create();
			if ($this->Phonebook->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The Phonebook has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Phonebook could not be saved. Please, try again.'));
			}
		}

		$this->set('categories', $this->Phonebook->Category->find('list', array('conditions' => array('Category.model' => 'Phonebook'))));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Phonebook->id = $id;
		if (!$this->Phonebook->exists()) {
			throw new NotFoundException(__('Invalid Phonebook'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Phonebook->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The Phonebook has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Phonebook could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Phonebook->read(null, $id);
		}
		$categories = $this->Phonebook->Category->find('list');
		$this->set('categories',$categories);
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Phonebook->id = $id;
		if (!$this->Phonebook->exists()) {
			throw new NotFoundException(__('Invalid Phonebook'));
		}
		if ($this->Phonebook->delete()) {
			$this->Session->setFlash(__('Phonebook deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Phonebook was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * search method
 *
 * @param string $id
 * @return void
 */
	public function search() {
		$query = '';
		if(!empty($this->request->query)) {
			$query = $this->request->query['search'];
		}else {
			throw new MethodNotAllowedException('No Search Provided');
		}
		
		App::uses('HttpSocket', 'Network/Http');
		
		$apikey = 'x1JbnWhgUK0snZDiWcxFkFrXkfugdrJKssWQpd7jX7Ml7pE3CbJWRbUbqorDPaoi';
		$url = 'http://zipcodedistanceapi.redline13.com/rest';
		
		if(!empty($query)) {
			$zip = $query;
		}
		

		$HttpSocket = new HttpSocket();
		
		// Get zipcodes by location
		//http://zipcodedistanceapi.redline13.com/rest/<api_key>/radius.<format>/<zip_code>/<distance>/<units>
		
		// Get zipcodes by radius of zip
		//http://zipcodedistanceapi.redline13.com/rest/<api_key>/city-zips.<format>/<city>/<state>
		$json = $HttpSocket->get($url.'/'.$apikey.'/radius.json/'.$zip.'/50/mile');
		
		$json = json_decode($json->body);
		
		$zips = array();
		foreach($json->zip_codes as $zipObj) {
			$zips[] = $zipObj->zip_code;
		}
		
		$this->set('locations', $this->Phonebook->find('all', array('conditions' => array('zip' => $zips))));
	}

/**
 * contact method
 *
 * @param string $id
 * @return void
 */
	public function contact($id = null) {
		$this->Phonebook->id = $id;
		if (!$this->Phonebook->exists()) {
			throw new NotFoundException(__('Invalid Listing'));
		}
		if ($this->request->is('post') || $this->request->is('push')) {
			$phonebook = $this->Phonebook->find('first', array('conditions' => array('Phonebook.id' => $id), 'contain' => array('Creator')));
			$email = $phonebook['Creator']['email'];
			$subject = __('%s received response on %s', $phonebook['Phonebook']['name'], __SYSTEM_SITE_NAME);
			$message = __('<p>Sender : %s</p><p>%s</p>', $this->request->data['Phonebook']['your_email'], strip_tags($this->request->data['Phonebook']['your_message']));
			
			if (!empty($email)) {
				try {
					$this->__sendMail($email, $subject, $message); 
					$this->Session->setFlash('Message sent');
					unset($this->request->data);
				} catch (Exception $e) {
					if (Configure::read('debug') > 0) {
						$this->Session->setFlash($e->getMessage());
					} else {
						$this->Session->setFlash('Error, please try again later.');
					}
				}
			} else {
				$this->Session->setFlash('Creator is not accepting contacts via email.');
			}
		}
		$this->Phonebook->contain(array('Category','Creator' => array('Gallery' => 'GalleryThumbnail')));
		$this->set('phonebook', $this->Phonebook->read(null, $id));
	}
	
}

if (!isset($refuseInit)) {
	class PhonebooksController extends AppPhonebooksController {}
}
