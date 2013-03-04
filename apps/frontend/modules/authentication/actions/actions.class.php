<?php

/**
 * main actions.
 *
 * @package    sf_sandbox
 * @subpackage main
 * @author     Khomenko Sergey
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class authenticationActions extends sfActions{
    public function validateIndex() {
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $this->client = new HotelsClient();
            if($this->getRequestParameter('submit') == 'signin'){
                $email = filter_var($this->getRequestParameter('signin[email]', ''), 
                    FILTER_VALIDATE_EMAIL);
                
                if(!$this->client->isClient($email)){
                    $this->getRequest()->
                        setError('signin_email', 'Invalid e-mail');
                }
            }
            if($this->getRequestParameter('submit') == 'registration') {
                $registration = $this->getRequestParameter('registration'); 

                //check first_name
                $registration['first_name'] = filter_var(
                    $registration['first_name'], 
                    FILTER_VALIDATE_REGEXP, 
                    array('options' => array('regexp' => '/[\w ]+/i'))
                );
                if(empty($registration['first_name'])){
                    $this->getRequest()->
                        setError('registration_first_name', 'Invalid first name');
                }

                //check last_name
                $registration['last_name'] = filter_var(
                    $registration['last_name'], 
                    FILTER_VALIDATE_REGEXP, 
                    array('options' => array('regexp' => '/[\w ]+/i'))
                );
                if(empty($registration['last_name'])){
                    $this->getRequest()->
                        setError('registration_last_name', 'Invalid last name');
                }

                //check email
                $registration['email'] = filter_var($registration['email'], 
                    FILTER_VALIDATE_EMAIL);
                if(empty($registration['email'])){
                    $this->getRequest()->
                        setError('registration_email', 'Invalid email');
                }
                if($this->client->isClient($registration['email'])){
                    $this->getRequest()->
                        setError('registration_email', 'That e-mail already exist');
                }

                //check phone number
                $registration['phone'] = filter_var($registration['phone'], 
                    FILTER_VALIDATE_REGEXP,
                    array('options' => array('regexp' => '/[0-9 \(\)\-]{6,20}/')));
                if(empty($registration['phone'])){
                    $this->getRequest()->
                        setError('registration_phone', 'Invalid phone number');
                }
            }
        }
        return !$this->getRequest()->hasErrors();
    }

    public function executeIndex () {
        if($this->getRequest()->getMethod() == sfRequest::POST) {
            if($this->getRequestParameter('submit') == 'signin'){
                $this->getUser()->setAttribute('client', 
                    $this->client->getClientByEmail(
                        $this->getRequestParameter('signin[email]'))
                    );
                $this->getUser()->setAuthenticated(true);
                $this->getUser()->addCredential('user');
                $this->redirectIf($this->getUser()->hasCredential('user'), 
                    $this->getRequest()->getUri());
            }
            if($this->getRequestParameter('submit') == 'registration') {
                $this->hotels_client = new HotelsClient();
                $this->updateHotelsClientFromRequest();
                $this->hotels_client->save();
                $this->getUser()->setAttribute('client', 
                    $this->client->getClientByEmail(
                        $this->getRequestParameter('signin[email]'))
                    );
                $this->getUser()->setAuthenticated(true);
                $this->getUser()->addCredential('user');
                return $this->redirect($this->getRequest()->getUri());
            }
        }
        $this->redirectIf($this->getUser()->hasCredential('user'), '@homepage');
    }

    public function handleErrorIndex() {
        $this->error_names_list = array(
            'registration' => array(
                'registration_first_name',
                'registration_last_name',
                'registration_email',
                'registration_phone',
            ), 
            'signin' => array('signin_email')
        );
        return sfView::SUCCESS;
    }

    public function executeLogout () {
        $this->getUser()->setAttribute('client', '');
        $this->getUser()->setAuthenticated(false);
        $this->redirect('@homepage');
    }

    protected function updateHotelsClientFromRequest(){
        $hotels_client = $this->getRequestParameter('registration');
        $this->hotels_client->set('first_name', $hotels_client['first_name']);
        $this->hotels_client->set('last_name', $hotels_client['last_name']);
        $this->hotels_client->set('email', $hotels_client['email']);
        $this->hotels_client->set('phone', $hotels_client['phone']);
    }
}
