<?php

/**
 * PluginsfUserBilling form.
 *
 * @package    form
 * @subpackage sfUserBilling
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version    SVN: $Id$
 */
abstract class PluginsfUserBillingForm extends BasesfUserBillingForm
{

  public function configure()
  {
    unset($this['updated_at'], $this['updated_by_user_id'],
          $this['created_at'], $this['created_by_user_id'],
          $this['rank']);
  }
}
