<?php
App::uses('AppController', 'Controller');
// App::import('Vendor', 'util/mylib');
//App::uses('Vendor', 'mylib');
// App::uses('Lib', 'appConst');
//App::uses('Vendor', 'ResponseComponent');
//App::import('Vendor', 'phpfunc');
// App::import('Vendor', 'util/AuthUtility');

/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
//	public $components = array('Paginator' );
	public $components = array('Paginator' ,'Session');

//	public $components = array(‘Response');
/*
    public $paginate = array(
        'limit' => 5,
        'order' => array(
            'Post.title' => 'desc'
        )
    );
*/
/**
 * index method
 *
 * @return void
 */
	public function index() {
		// var_dump($this->Session->read('sess_login') ) ;
		$this->Post->recursive = 0;
//		$this->Paginator->setting = $this->paginate;
	    $this->Paginator->settings = array(
         'limit' => 10 ,'order'=> array('Post.created'=>'asc')
	    );
//        'conditions' => array('Post.id' > 0), 'limit' => 10

//		$data = $this->Paginator->paginate();
//		$this->paginate= array('consitions'=array('limit'=>1 ) );
//		$data = $this->paginate('Post' ,array('title'=>'t1' ));
		//$data = $this->paginate('Post');
		// var_dump($this->Paginator->params() );
		$this->set('posts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
	public function add2() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
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
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
			//
			$this->set('post', $this->request->data );
			
//			var_dump($this->request->data );
//			exit();
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
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete()) {
//			$this->Flash->success(__('The post has been deleted.'));
			$this->Flash->success(__('The post を削除しました。'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	// hasMany
	public function test() {
//		$dao    = ClassRegistry::init('Post');
//		$posts = $dao->find('all');
		$posts = $this->Post->find('all' );
//		var_dump($posts['Tag']);
		var_dump($posts );
		exit();
		// var_dump($posts[0]["Tag"][0]["tag"] );
		//var_dump($posts[0]["Tag"][0]["tag"] );
		foreach( $posts as $post){
			$tags= $post["Tag"];
			foreach($tags  as $tag){
				echo $tag["id"] . ", " .$tag["tag"] . "<br />";
			}
//			echo $post["Post"]['id'];
//			echo $post["Post"]['id'] . "<BR />";
			// var_dump $post;
		}
		exit();
	}
	//
		public function test2() {
		//	$this->app_f01();
		//	echo C_SITE_NAME . "<br />";
			
//		$con = new AppConst();
		// phpfunc_f01();
//		$mylib = new Mylib();
		// $this->Helper::c('hello');
		//$dao    = ClassRegistry::init('Post');
//		$posts = $dao->find('all');
//		$posts = $this->Post->find('all' );
//		$posts = $this->Post->find('all' , ['conditions' => array('Post.id' => 1)]		);
		$posts = $this->Post->find('all' );
//		$posts = $this->Post->find('all' ,array('conditions' => array('Post.id' => 1)) );
//		$posts = $dao->find('all' , ['conditions' => array('id' => 1)]);
//		var_dump($posts[0]["Tag"][0]["tag"] );
		// var_dump($posts[0]["Tag"]["tag"] );
//		var_dump($posts[0]);
		foreach( $posts as $post){
//			var_dump( $post["Post"]["id"])  . "<br />";
//			echo  $post["Post"]["id"] . "<br />";
			
			$tag=  $post["Tag"];
//			echo $tag["id"] . ", " .$tag["tag"] . "<br />";
			// echo $post["Post"]["id"] . $post["Post"]["title"] . ", " .$tag["tag"] . "<br />";
//			echo $post["Post"]['id'];
//			echo $post["Post"]['id'] . "<BR />";
			// var_dump $post;
		}
		$this->set('posts', $this->Paginator->paginate());
//		exit();
	}
	//
    public function delete_ajax(){
    	$response = array('result'=> 0 );
//	    	echo json_encode($response );
//	    	exit();
    	if ($this->request->is('get')) {
	    	$rQuery =$this->request->query;
	    	//delete
			$this->Post->id =$rQuery['id'];
			if (!$this->Post->exists()) {
		    	echo json_encode($response );
		    	exit();
			}
			if ($this->Post->delete()) {
				$response = array('result'=> 1 );
		    	echo json_encode($response );
		    	exit();
			} else {
		    	echo json_encode($response );
		    	exit();
			}
    	}
    	//else{
	    //	echo json_encode($response );
	    //	exit();
    	//}
    }
	//
    public function test1(){
    	$response = array('result'=> '1');
    	echo json_encode($response );
    	exit();
    }
    //
    public function test3(){
//	  $this->Flash->error(__('The post could not be deleted. Please, try again.'));
		$this->Flash->success(__('The post を削除しました。'));
//	  exit();
    }
	
}
