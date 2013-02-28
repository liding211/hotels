<?php

/**
 * main actions.
 *
 * @package    sf_sandbox
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class authenticationActions extends sfActions{
    /**
     * Executes index action
     *
     */
  public function validateIndex() {
    if($this->getRequest()->getMethod()==sfRequest::POST) {
        if($this->getRequestParameter('submit') == 'login'){
            $params['email'] = $this->getRequestParameter('login');
            $params['password'] = $this->getRequestParameter('password');

            $admin['email'] = 'admin';
            $admin['password'] = 'admin';
            if($params['email'] != $admin['email'] OR $params['password'] != $admin['password']){
                $this->getRequest()->setError('login', 'Invalid login or password');
            }
        }
    }
    return !$this->getRequest()->hasErrors();
  }
  
  public function validateRegistration(){
      if($this->getRequest()->getMethod()==sfRequest::POST) {
        if($this->getRequestParameter('submit') == 'registration'){
            $params['email'] = $this->getRequestParameter('login');
            $params['password'] = $this->getRequestParameter('password');

            $admin['email'] = 'admin';
            $admin['password'] = 'admin';
            if($params['email'] != $admin['email'] OR $params['password'] != $admin['password']){
                $this->getRequest()->setError('login', 'Invalid login or password');
            }
        }
        
    }
    return !$this->getRequest()->hasErrors();
  }
  
  public function executeIndex () {
    if($this->getRequest()->getMethod() == sfRequest::POST) {
//      $this->getUser()->setAuthenticated(true);
//      $this->getUser()->addCredential('user');
//      $this->redirect($this->getRequest()->getUri());
      //$this->redirectIf($this->getUser()->hasCredential('user'), '@homepage');
    }
  }
  
  public function executeRegistration(){
    if($this->getRequest()->getMethod() == sfRequest::POST) {
//      $this->getUser()->setAuthenticated(true);
//      $this->getUser()->addCredential('user');
//      $this->redirect($this->getRequest()->getUri());
      //$this->redirectIf($this->getUser()->hasCredential('user'), '@homepage');
    }
    $this->redirect('');
  }
  
  public function handleErrorLogin() {
    return sfView::SUCCESS;
  }

  public function executeLogout () {
    $this->getUser()->setAuthenticated(false);
    $this->redirect('@homepage');
  }
}
