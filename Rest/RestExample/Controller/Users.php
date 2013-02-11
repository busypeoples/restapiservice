<?php

namespace RestExample\Controller;
use RestExample\AbstractController;

class Users extends AbstractController {
    
    public function get() {
       	
		$id = $this->getRequest()->getParam('id');
		if ($id) {
			$data = array('message' => 'retrieved the data for ID : ' . $id);
		} else {
        	$data = array('message' => 'retrieved all data.');
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
