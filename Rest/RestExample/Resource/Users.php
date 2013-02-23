<?php

namespace RestExample\Resource;

class Users extends \RestExample\Resource {

    public function getAction() {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $data = array('message' => 'retrieved the data for user with the ID : ' . $id);
        } else {
            $data = array('message' => 'retrieved all data.');
        }
        $this->setParam('data', $data);
        $this->getResponse()->setStatusCode("200 OK");
    }

    public function postAction() {
        $name = $this->getRequest()->getParam('name');
        $data = array(
                    'message' => 'Called Action : ' . __FUNCTION__ .
                    '...successfully added a new user' . 
                    'with the name = ' . $name 
                    );
        $this->setParam('data', $data);
        $this->getResponse()->setStatusCode("201 CREATED");
    }

    public function putAction() {
        $id = $this->getRequest()->getParam('id');
        $name = $this->getRequest()->getParam('name');    
        $data = array(
                        'message' => 'Called Action : ' . __FUNCTION__ . 
                        '... successfully updated ID : ' . $id . 
                        'with the name = ' . $name                    
                    );
        $this->setParam('data', $data);
        $this->getResponse()->setStatusCode("200 OK");
    }

    public function deleteAction() {
        $id = $this->getRequest()->getParam('id');
        $data = array(' message' => 'Called Action : ' .  __FUNCTION__ .
                              '...  successfully deleted user with the ID : ' . $id
                        );
        $this->setParam('data', $data);
        $this->getResponse()->setStatusCode("200 OK");
    }

}
