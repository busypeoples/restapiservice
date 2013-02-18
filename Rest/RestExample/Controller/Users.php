<?php

namespace RestExample\Controller;
use RestExample\AbstractController;

class Users extends AbstractController {

    public function get() {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $data = array('message' => 'retrieved the data for user with the ID : ' . $id);
        } else {
            $data = array('message' => 'retrieved all data.');
        }
        $this->getView()->setParam('data', $data);
    }

    public function add() {
                $name = $this->getRequest()->getParam('name');
        $data = array(
                    'message' => 'Called Action : ' . __FUNCTION__ .
                    '...successfully added a new user' . 
                    'with the name = ' . $name 
                    );
        $this->getView()->setParam('data', $data);
    }

    public function update() {
        $id = $this->getRequest()->getParam('id');
                $name = $this->getRequest()->getParam('name');    
        $data = array(
                        'message' => 'Called Action : ' . __FUNCTION__ . 
                        '... successfully updated ID : ' . $id . 
                        'with the name = ' . $name                    
                    );
        $this->getView()->setParam('data', $data);
    }

    public function delete() {
        $id = $this->getRequest()->getParam('id');
        $data = array(' message' => 'Called Action : ' .  __FUNCTION__ .
                              '...  successfully deleted user with the ID : ' . $id
                        );
        $this->getView()->setParam('data', $data);
    }

}
