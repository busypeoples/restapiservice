<?php

namespace RestExample\Controller;
use RestExample\AbstractController;

class User extends AbstractController {
    
    public function get() {
       	
		$id = $this->getRequest()->getParam('id');
		if ($id) {
			$data = array('message' => 'retrieved the data for ID : ' . $id);
		} else {
        	$data = array('message' => __FUNCTION__, 'data' => array(array(1, 'ID : 1', 45), array(2, 'ID : 2', 33)));
        }
		$this->getView()->setParam('data', $data);
    }
    
    public function add() {
        
		$data = array('message' => __FUNCTION__, 'data' => 'added some new user');
        $this->getView()->setParam('data', $data);
    }
    
    public function update() {
        $id = $this->getRequest()->getParam('id');

        $data = array('message' => 'Called Action : ' . __FUNCTION__ . '... successfully updated ID : ' . $id);
        $this->getView()->setParam('data', $data);
    }
    
    public function delete() {
        $id = $this->getRequest()->getParam('id');
		$data = array('message' => 'Called Action : ' .  __FUNCTION__ . '...  successfully deleted ID : ' . $id);
        $this->getView()->setParam('data', $data);
    }
    
}
