<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 */
class Post extends AppModel {
	/*
    public $hasMany = array(
            'Tag' => array(
                'className' => 'Tag',
                'foreignKey' => 'post_id',
            )
        );
	*/
    //
        public $hasOne = array(
            'Tag' => array(
                'className' => 'Tag',
                'foreignKey' => 'post_id',
            )
        );

}
