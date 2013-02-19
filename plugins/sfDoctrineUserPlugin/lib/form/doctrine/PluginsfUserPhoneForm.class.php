<?php

/**
 * PluginsfUserPhone form.
 *
 * @package    form
 * @subpackage sfUserPhone
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfUserPhoneForm extends BasesfUserPhoneForm
{
  public function setup()
  {
    parent::setup();

    $this->getWidget('phone_type_id')->setLabel('Phone Type');
  }

  public function configure()
  {
    unset($this['updated_at'], $this['updated_by_user_id'],
          $this['created_at'], $this['created_by_user_id'],
          $this['rank']);
  }
}
