<?php

/**
 * PluginsfUserAddress form.
 *
 * @package    form
 * @subpackage sfUserAddress
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfUserAddressForm extends BasesfUserAddressForm
{
  public function setup()
  {
    parent::setup();

    $this->getWidget('address_type_id')->setLabel('Address Type');
    $this->getWidget('state_id')->setLabel('State');
    $this->getWidget('address1')->setLabel('Address 1');
    $this->getWidget('address2')->setLabel('Address 2');
    $this->getWidget('address3')->setLabel('Address 3');
  }

  public function configure()
  {
    unset($this['updated_at'], $this['updated_by_user_id'],
          $this['created_at'], $this['created_by_user_id'],
          $this['rank']);
  }
}
