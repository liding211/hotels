<?php

class sfUserGuardUserForm extends sfGuardUserForm
{
  public function setup()
  {
    parent::setup();

    # Setup proper password validation with confirmation
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
    $this->widgetSchema->moveField('password_confirmation', sfWidgetFormSchema::AFTER, 'password');

    $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_confirmation', array(), array('invalid' => 'The two passwords must be the same.')));

    $this->validatorSchema['username'] = new sfValidatorString(array(),array(
      'required' => 'You must enter a username'
    ));

    $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
    $this->validatorSchema['password']->setOption('required', true);
    $this->validatorSchema['password'] = new sfValidatorString(array(),array(
      'required' => 'You must enter a password'
    ));

    $this->validatorSchema['password_confirmation'] = new sfValidatorString(array(),array(
      'required' => 'You must enter your password again'
    ));
  }

}
