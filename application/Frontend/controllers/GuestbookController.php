<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $guestbook = new Models_GuestbookMapper();
        $this->view->entries = $guestbook->fetchAll();
    }

    public function signAction()
    {
        $request = $this->getRequest();
        $form    = $this->getForm();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Models_Guestbook($form->getValues());
                $mapper  = new Models_GuestbookMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }
    
    public function getForm()
    {
    	require_once APPLICATION_PATH . '/forms/Guestbook.php';
    	
    	return new Forms_Guestbook();
    }


}



