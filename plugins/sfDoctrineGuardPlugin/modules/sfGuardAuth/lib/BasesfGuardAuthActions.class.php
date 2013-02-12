<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: BasesfGuardAuthActions.class.php 1949 2006-09-05 14:40:20Z fabien $
 */
class BasesfGuardAuthActions extends sfActions
{
  public function executeSignin()
  {
    $user = $this->getUser();
	
	if ($user->isAuthenticated())
    {
      $this->redirect('@homepage');
    }
	
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $referer = $user->getAttribute('referer', $this->getRequest()->getReferer());
      $user->getAttributeHolder()->remove('referer');
      
      $referer = ($referer != '' ? $referer : (!strstr($_SERVER['REQUEST_URI'], '/login') ? $_SERVER['REQUEST_URI'] : ''));

      $signin_url = sfConfig::get('app_sf_guard_plugin_success_signin_url', $referer);

      $this->redirectIf($this->getUser()->hasCredential('contract_data_entry_person'), 'contract/index');
      $this->redirectIf($this->getUser()->hasCredential('contract_validator'), 'validator_contract/index');
      $this->redirectIf($this->getUser()->hasCredential('contract_validator'), 'validator_contract/index');
      $this->redirectIf($this->getUser()->hasCredential('financial'), 'report/list');
      $this->redirectIf($this->getUser()->hasCredential('esp_report'), 'campaign/index');
      $this->redirectIf($this->getUser()->hasCredential('contract_salesperson'), 'salesperson_contract/portal');
      $this->redirect('' != $signin_url ? $signin_url : '@homepage');
    }
    elseif ($user->isAuthenticated())
    {
      $this->redirect('@homepage');
    }
    else
    {
      if ($this->getRequest()->isXmlHttpRequest())
      {
        $this->getResponse()->setHeaderOnly(true);
        $this->getResponse()->setStatusCode(401);

        return sfView::NONE;
      }

      if (!$user->hasAttribute('referer'))
      {
        $user->setAttribute('referer', $this->getRequest()->getReferer());
      }

      if ($this->getModuleName() != ($module = sfConfig::get('sf_login_module')))
      {
        return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
      }

      $this->getResponse()->setStatusCode(401);
    }
  }

  public function handleErrorSignin()
  {
    $user = $this->getUser();
    if (!$user->hasAttribute('referer'))
    {
      $user->setAttribute('referer', $this->getRequest()->getReferer());
    }

    if ($this->getModuleName() != ($module = sfConfig::get('sf_login_module')))
    {
      $this->forward($module, sfConfig::get('sf_login_action'));
    }

    return sfView::SUCCESS;
  }

  public function executeSignout()
  {
    $this->getUser()->signOut();

    $signout_url = sfConfig::get('app_sf_guard_plugin_success_signout_url', $this->getRequest()->getReferer());

    $this->redirect('' != $signout_url ? $signout_url : '@homepage');
  }

  public function executeSecure()
  {
    $this->getResponse()->setStatusCode(403);
  }
}