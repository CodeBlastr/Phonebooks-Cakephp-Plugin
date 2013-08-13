<?php
App::uses('PhonebooksAppController', 'Phonebooks.Controller');
/**
 * Directories Controller
 *
 * @property Phonebook $Phonebook
 */
class PhonebooksController extends PhonebooksAppController {

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
		$this->set('phonebooks', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Phonebook->id = $id;
		if (!$this->Phonebook->exists()) {
			throw new NotFoundException(__('Invalid Phonebook'));
		}
		$this->set('Phonebook', $this->Phonebook->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->view = 'add_edit';
		
		if ($this->request->is('post')) {
			
			$this->Phonebook->create();
			if ($this->Phonebook->save($this->request->data)) {
				$this->Session->setFlash(__('The Phonebook has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Phonebook could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->view = 'add_edit';
		$this->Phonebook->id = $id;
		if (!$this->Phonebook->exists()) {
			throw new NotFoundException(__('Invalid Phonebook'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Phonebook->save($this->request->data)) {
				$this->Session->setFlash(__('The Phonebook has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Phonebook could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Phonebook->read(null, $id);
		}
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
	
}
