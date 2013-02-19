<?php

/**
 * sfUserSimpleRegistrationForm
 * This is a form containing one of each object for an sfUser
 *
 * @package sfDoctrineUserPlugin
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @copyright 2009 Stephen Ostrow
 * @license See LICENSE that came packaged with this software
 * @version SVN: $Id$
 *
 * @todo Remove all the setFormFormatterName() calls from this class.  Currently there is now way to override it later so I'm leaving it in here and you'll just have to use definition lists
 */
class sfUserSimpleRegistrationForm extends sfUserSimpleUserForm
{
  public function configure()
  {
    parent::configure();

    # Setup the GuardUser information
    $sf_guard_user_form_widget = $this->widgetSchema['sf_guard_user'];
     unset(
      $sf_guard_user_form_widget['is_active'],
      $sf_guard_user_form_widget['is_super_admin'],
      $sf_guard_user_form_widget['groups_list'],
      $sf_guard_user_form_widget['permissions_list']
    );

    $sf_guard_user_form_validator = $this->validatorSchema['sf_guard_user'];
    $sf_guard_user_form_validator['password']->setOption('required', true);
    $sf_guard_user_form_validator['password_confirmation']->setOption('required', true);

    $this->widgetSchema->setNameFormat('registration[%s]');


  }
}
