<?php

/**
 * PluginsfUserEmailAddress form.
 *
 * @package    form
 * @subpackage sfUserEmailAddress
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfUserEmailAddressForm extends BasesfUserEmailAddressForm
{
  public function setup()
  {
    parent::setup();

    $this->getWidget('email_address_type_id')->setLabel('Email Address Type');
    $this->getWidget('address')->setLabel('Email Address');
  }

  public function configure()
  {
    unset($this['updated_at'], $this['updated_by_user_id'],
          $this['created_at'], $this['created_by_user_id'],
          $this['rank']);
  }
}
