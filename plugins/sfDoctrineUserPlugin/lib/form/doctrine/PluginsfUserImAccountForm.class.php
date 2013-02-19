<?php

/**
 * PluginsfUserImAccount form.
 *
 * @package    form
 * @subpackage sfUserImAccount
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfUserImAccountForm extends BasesfUserImAccountForm
{
  public function setup()
  {
    parent::setup();

    $this->getWidget('im_account_type_id')->setLabel('IM Account Type');
  }

  public function configure()
  {
    unset($this['updated_at'], $this['updated_by_user_id'],
          $this['created_at'], $this['created_by_user_id'],
          $this['rank']);
  }
}
