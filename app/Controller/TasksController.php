<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->Paginator->paginate());
	}
	//
	public function api_index() {
		$this->Task->recursive = 0;
	    $this->Paginator->settings = array(
			'limit' => 10 ,'order'=> array('Task.id'=>'desc')
		   );		
		$dats = $this->Paginator->paginate();
		$arr = array();
		foreach ($dats as $dat){
			$arr[] = $dat["Task"];
		}
//		var_dump($arr );
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		echo(json_encode($arr ));
		exit();
	}	
	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
		$this->set('task', $this->Task->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
//var_dump($this->request->data );
//exit();
			$this->Task->create();
			if ($this->Task->save($this->request->data)) {
				$this->Flash->success(__('The task has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The task could not be saved. Please, try again.'));
			}
		}
	}
	//
	public function api_add() {
		if ($this->request->is('post')) {
			$this->Task->create();
			$json ='';
			if ($this->Task->save($this->request->data)) {
				$json = json_encode(['title' => $this->request->data["Task"] ]);
			} else {
				$json = json_encode(['message' => 'The task could not be saved. Please, try again.' ]);
			}
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
			echo( $json );
			exit();
		}
	}
	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Task->save($this->request->data)) {
				$this->Flash->success(__('The task has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The task could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
			$this->request->data = $this->Task->find('first', $options);
		}
	}
	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Task->delete($id)) {
			$this->Flash->success(__('The task has been deleted.'));
		} else {
			$this->Flash->error(__('The task could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
