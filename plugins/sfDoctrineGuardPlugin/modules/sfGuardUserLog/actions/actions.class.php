<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardUserLogActions.class.php');

/**
 * User management.
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 3109 2006-12-23 07:52:31Z fabien $
 */
class sfGuardUserLogActions extends BasesfGuardUserLogActions
{

	public function executeList ()
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/sf_guard_user_log/filters');
    // pager
    $this->pager = new sfDoctrinePager('sfGuardUserLog', 20);

    $this->addSortCriteria($this->pager->getQuery());
    $this->addFiltersCriteria($this->pager->getQuery());
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/sf_guard_user_log')));

    $count = $this->pager->getQuery()->select("COUNT(*) AS count_page")->fetchOne();

    $this->pager->setNbResults($count->count_page);

    $p = $this->pager->getQuery()->select("*");;
    if ($this->pager->getPage() == 0 || $this->pager->getMaxPerPage() == 0)
    {
      $this->pager->setLastPage(0);
    } else {
      $offset = ($this->pager->getPage() - 1) * $this->pager->getMaxPerPage();

      $this->pager->setLastPage(ceil($this->pager->getNbResults() / $this->pager->getMaxPerPage()));

      $p->offset($offset);
      $p->limit($this->pager->getMaxPerPage());
    }

    // Save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/sf_guard_user_log');
    }
  }

}
