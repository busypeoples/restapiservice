<?php

namespace RestExample\Controller;
use RestExample\AbstractController;

class User extends AbstractController {
    
    public function get() {
        
        $data = array('message' => __FUNCTION__, 'data' => array(array(1, 'userA', 45), array(4, 'userB', 33)));
        $this->getView()->setParam('data', $data);
    }
    
    public function add() {
        $data = array('message' => __FUNCTION__, 'data' => 'added some new user');
        $this->getView()->setParam('data', $data);
    }
    
    public function update() {
                  $id = $this->getRequest()->getParam('id');

        $data = array('message' => __FUNCTION__, 'data' => 'updated whatever was needed with the id ' . $id);
        $this->getView()->setParam('data', $data);
    }
    
    public function delete() {
        $data = array('message' => __FUNCTION__, 'data' => 'successfully deleted this one!.');
        $this->getView()->setParam('data', $data);
    }
    
}
