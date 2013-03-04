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
            $email = filter_var($this->getRequestParameter('signin[email]', ''), 
                FILTER_VALIDATE_EMAIL);

            $client = Doctrine_Manager::connection()->
                fetchRow('SELECT id, first_name FROM hotels_client 
                    WHERE email = ?', 
                    array($email));
            if(empty($client)){
                $this->getRequest()->
                    setError('signin_email', 'Invalid e-mail');
            }else{
                $this->getUser()->setAttribute('id', $client['id']);
                $this->getUser()->
                    setAttribute('first_name', $client['first_name']);
            }
        }
        return !$this->getRequest()->hasErrors();
    }

    public function validateRegistration(){
        if($this->getRequest()->getMethod()==sfRequest::POST) {
            $this->registration = $this->getRequestParameter('registration'); 

            //check first_name
            $this->registration['first_name'] = filter_var(
                $this->registration['first_name'], 
                FILTER_VALIDATE_REGEXP, 
                array('options' => array('regexp' => '/[\w ]+/i'))
            );
            if(empty($this->registration['first_name'])){
                $this->getRequest()->
                    setError('registration_first_name', 'Invalid first name');
            }

            //check last_name
            $this->registration['last_name'] = filter_var(
                $this->registration['last_name'], 
                FILTER_VALIDATE_REGEXP, 
                array('options' => array('regexp' => '/[\w ]+/i'))
            );
            if(empty($this->registration['last_name'])){
                $this->getRequest()->
                    setError('registration_last_name', 'Invalid last name');
            }

            //check email
            $this->registration['email'] = filter_var($this->registration['email'], 
                FILTER_VALIDATE_EMAIL);
            if(empty($this->registration['email'])){
                $this->getRequest()->
                    setError('registration_email', 'Invalid email');
            }
            $client = Doctrine_Manager::connection()->
                fetchRow('SELECT id FROM hotels_client 
                    WHERE email = ?', 
                    array($this->registration['email']));
            if(!empty($client)){
                $this->getRequest()->
                    setError('registration_email', 'That e-mail already exist');
            }

            //check phone number
            $this->registration['phone'] = filter_var($this->registration['phone'], 
                FILTER_VALIDATE_REGEXP,
                array('options' => array('regexp' => '/[0-9 \(\)\-]{6,20}/')));
            if(empty($this->registration['phone'])){
                $this->getRequest()->
                    setError('registration_phone', 'Invalid phone number');
            }
        }
        return !$this->getRequest()->hasErrors();
    }

    public function executeIndex () {
        if($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->getUser()->setAuthenticated(true);
            $this->getUser()->addCredential('user');
            $this->redirectIf($this->getUser()->hasCredential('user'), 
                $this->getRequest()->getUri());
        }
    }

    public function executeRegistration(){
        if($this->getRequest()->getMethod() == sfRequest::POST) {
            $this->hotels_client = new HotelsClient();
            $this->updateHotelsClientFromRequest();
            $this->hotels_client->save();
            $this->getUser()->setAttribute('id', $this->hotels_client->id);
            $this->getUser()->
                setAttribute('first_name', $this->hotels_client->first_name);
            $this->getUser()->setAuthenticated(true);
            $this->getUser()->addCredential('user');
            return $this->redirect($this->getRequest()->getUri());
        }
        $this->forwardIf($this->getUser()->hasCredential('user'), 'room', 'index');
        $this->forward('authentication', 'index');
    }

    public function handleErrorRegistration() {
        $this->forward('authentication', 'index');
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
