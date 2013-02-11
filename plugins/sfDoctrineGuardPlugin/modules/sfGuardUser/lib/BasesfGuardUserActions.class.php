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
 * @version    SVN: $Id$
 */
class BasesfGuardUserActions extends autosfGuardUserActions
{
  public function validateEdit()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST && !$this->getRequestParameter('id'))
    {
      if ($this->getRequestParameter('sf_guard_user[password]') == '')
      {
        $this->getRequest()->setError('sf_guard_user{password}', 'Password is mandatory');

        return false;
      }
    }

    return true;
  }
  
  protected function savesfGuardUser($sf_guard_user)
  {
    $sf_guard_user->save();
#    $all = $sf_guard_user->getAllPermissionNames();
#    if(in_array('contract_salesperson', $all) && !isset($sf_guard_user->Salesperson)){
#    	$sf_guard_user->Salesperson->name = $sf_guard_user->full_name;
#    	$sf_guard_user->Salesperson->save();
#    }	
  }
  
  
  public function executeList_log(){
  	$user_id = intval($this->getRequestParameter('id',0));
  	$filters['user_id'] = $user_id;
  	$this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/sf_guard_user_log');
  	$this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/sf_guard_user_log/filters');
  	$this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/sf_guard_user_log/filters');
  	$this->redirect("sfGuardUserLog/list");
  }	
  
  public function executeList_login(){
  	$user_id = intval($this->getRequestParameter('id',0));
  	$filters['user_id'] = $user_id;
  	$this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/sf_guard_user_login');
  	$this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/sf_guard_user_login/filters');
  	$this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/sf_guard_user_login/filters');
  	$this->redirect("sfGuardUserLogin/list");
  }	  
  
}
