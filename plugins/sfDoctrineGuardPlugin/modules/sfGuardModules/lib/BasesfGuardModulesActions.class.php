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
class BasesfGuardModulesActions extends autosfGuardModulesActions
{
  public function validateEdit()
  {
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $action_name = $this->getRequestParameter('sf_guard_modules[action_name]');
      $module_name = $this->getRequestParameter('sf_guard_modules[module_name]');	
      $module = Doctrine::getTable('sfGuardModules')->retrieveByActionNameAndModuleName($action_name, $module_name);	
      if ((int)$module->id != (int)$this->getRequestParameter('id') && (int)$module->id > 0)
      {
        $this->getRequest()->setError('sf_guard_modules{action_name}', 'action name alredy');
        return false;
      }
    }

    return true;
  }
}
