<?php

/**
 * sfDoctrineUserPlugin configuration.
 *
 * @package     sfDoctrineUserPlugin
 * @subpackage  config
 * @author      Stephen Ostrow <sostrow@sowebdesigns.com>
 * @version     SVN: $Id$
 */
class sfDoctrineUserPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $modules = array(
                    'sfUserAdvancedUser', 'sfUserSimpleUser',
                    'sfUserUser',
                    'sfUserAddress', 'sfUserBilling', 'sfUserEmailAddress', 'sfUserEmailAddress', 'sfUserImAccount', 'sfUserPhone',
                    'sfUserAddressType', 'sfUserCreditCardType', 'sfUserImAccountType', 'sfUserEmailAddressType', 'sfUserPhoneType',
                    'sfUserCountry', 'sfUserState',
                    );
    foreach ($modules as $module)
    {
      if (in_array($module, sfConfig::get('sf_enabled_modules', array())))
      {
        $this->dispatcher->connect('routing.load_configuration', array('sfUserRouting', 'addRouteForAdmin'.str_replace('sfUser', '', $module)));
      }
    }

  }
}
