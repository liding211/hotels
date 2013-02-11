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
class BasesfGuardUserLoginActions extends autosfGuardUserLoginActions
{
 
  public function executeCreate ()
  {
    return $this->redirect('sfGuardUserLogin/list');
  }

  public function executeSave ()
  {
    return $this->redirect('sfGuardUserLogin/list');
  }

  public function executeEdit ()
  {
    return $this->redirect('sfGuardUserLogin/list');
  }

  public function executeDelete ()
  {
    return $this->redirect('sfGuardUserLogin/list');
  }


  protected function savesfGuardUserLogin($sf_guard_user_login)
  {
    return $this->redirect('sfGuardUserLogin/list');
  }

  protected function deletesfGuardUserLogin($sf_guard_user_login)
  {
    return $this->redirect('sfGuardUserLogin/list');
  }
	
	
}
