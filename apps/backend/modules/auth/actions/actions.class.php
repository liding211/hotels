<?php
/**
 * city actions.
 *
 * @package    ouffer
 * @subpackage city
 * @author     Your name here
 */
class authActions extends sfActions {
  public function validateLogin() {
    if($this->getRequest()->getMethod()==sfRequest::POST) {
        $params['email'] = $this->getRequestParameter('login');
        $params['password'] = $this->getRequestParameter('password');

        $admin['email'] = 'admin';
        $admin['password'] = 'admin';
        //var_dump($params);
        if($params['email'] != $admin['email'] OR $params['password'] != $admin['password']){
            $this->getRequest()->setError('login', 'Invalid login or password');
        }
    }
    return !$this->getRequest()->hasErrors();
  }
  
  public function executeLogin () {
    if($this->getRequest()->getMethod() == sfRequest::POST) {
      $this->getUser()->setAuthenticated(true);
      $this->getUser()->addCredential('admin');
      $this->redirect($this->getRequest()->getUri());
    }
  }

  public function handleErrorLogin() {
    return sfView::SUCCESS;
  }

  public function executeLogout () {
    $this->getUser()->setAuthenticated(false);
    $this->redirect('@homepage');
  }
}
