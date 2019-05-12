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
		$this->out_crosHead();
		echo(json_encode($arr ));
		exit();
	}	
	//
	public function api_view($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
		$dat = $this->Task->find('first', $options);
		$this->out_crosHead();		
		echo(json_encode($dat["Task"]));
		exit();
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
			$this->out_crosHead();
			echo( $json );
			exit();
		}
	}
	//
	public function api_edit($id = null) {
		$json ='';
		if (!$this->Task->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
			$arr = array();
			$dat = $this->Task->find('first', $options);
			$arr[] = $dat["Task"];
			$json = json_encode($arr);
		}
		$this->out_crosHead();
		echo( $json );
		exit();		
	}
	//
	public function api_update($id = null) {
		$json ='';
		if (!$this->Task->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Task->save($this->request->data)) {
					$json = json_encode(['title' => $this->request->data["Task"] ]);
				} else {
					$json = json_encode(['message' => 'The task could not be saved. Please, try again.' ]);
				}
			}
		}
		$this->out_crosHead();
		echo( $json );
		exit();
	}
	//
	public function api_delete($id = null) {
		$json ='';
		if (!$this->Task->exists($id)) {
			$arr = array(
				'message' => 'Invalid task',
				'ret' => 0,
			);
			$json = json_encode($arr);
		}else{
			if ($this->Task->delete($id)) {
				$arr = array(
					'message' => 'OK deleted.',
					'ret' => 1,
				);
				$json = json_encode($arr);
			} else {
				$arr = array(
					'message' => 'The task could not be deleted. Please, try again.',
					'ret' => 0,
				);
				$json = json_encode($arr);
			}
		}
		$this->out_crosHead();
		echo( $json );
		exit();	
	}
	//
	public function test($id = null) {
		$arr = array(
			'message' => 'OK deleted.',
			'ret' => 1,
		);
		$json = json_encode($arr);
		$this->out_crosHead();
		echo( $json );
		exit();			
	}

}
