<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Processes the "remember me" cookie.
 * 
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id$
 * 
 * @deprecated Use {@link sfGuardRememberMeFilter} instead
 */
class sfGuardBasicSecurityFilter extends sfBasicSecurityFilter
{
  public function execute($filterChain)
  {
  	$context    = $this->getContext();
    $controller = $context->getController();
    $requesParameter = $context->getRequest()->getParameterHolder()->getAll();
    
    // get the current action instance
    $actionEntry    = $controller->getActionStack()->getLastEntry();
    $actionInstance = $actionEntry->getActionInstance();
    
    $action_name = strtolower($actionInstance->getActionName());
    $module_name = strtolower($actionInstance->getModuleName());
    
    $l = false;
    if(strtolower($module_name) == 'sfguarduser'){
    	$l = true;
    	$r = $this->context->getUser()->checkEditMyAcc(strtolower($module_name), $action_name, $requesParameter);
    }
    $this->context->getUser()->setModules($module_name, $action_name);
    $secure[$action_name]['is_secure'] = $this->context->getUser()->getModulesIsSecure();
    $secure[$action_name]['credentials'] = $l && $r ? '' : $this->context->getUser()->getModulesCredential();
    
    if(!empty($secure[$action_name]['credentials'])){
    	$actionInstance->setSecurityConfiguration($secure);
    }
    
    $requesParameter['FILES'] = $_FILES;
    
    $this->context->getUser()->setLog($module_name, $action_name, $requesParameter);
    
    //$credential = $actionInstance->getCredential();
    //$is_secure = $actionInstance->isSecure();
    
    $cookieName = sfConfig::get('app_sf_guard_plugin_remember_cookie_name', 'sfRemember');

    if ($this->isFirstCall())
    {
      $this->context->getLogger()->notice(sprintf('The filter "%s" is deprecated. Use "sfGuardRememberMeFilter" instead.', __CLASS__));

      if (
        $this->context->getUser()->isAnonymous()
        &&
        $cookie = $this->getContext()->getRequest()->getCookie($cookieName)
      )
      {
        $rk = Doctrine_Query::create()
                ->from('sfGuardRememberKey')
                ->where('sfGuardRememberKey.remember_key = ?', $cookie)
                ->execute()
                ->getFirst();

        if ($rk)
        {
          $user = $rk->getUser();

          if ($user instanceof sfGuardUser && $user->exists())
          {
            $this->context->getUser()->signIn($user);
          }
        }
      }
    }

    parent::execute($filterChain);
  }
}
