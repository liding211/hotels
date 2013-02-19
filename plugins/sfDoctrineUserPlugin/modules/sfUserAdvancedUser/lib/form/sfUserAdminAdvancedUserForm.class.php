<?php

/**
 * sfUserAdminAdvancedUserForm
 * This is a form extending sfUserAdvancedUserForm.  It also contains the updated_at, created_at, updated_by, created_by fields as plain text
 *
 * @package sfDoctrineUserPlugin
 * @author Stephen Ostrow <sostrow@sowebdesigns.com>
 * @copyright 2009 Stephen Ostrow
 * @license See LICENSE that came packaged with this software
 * @version SVN: $Id$
 *
 * @todo Add in rank moving of objects via two new actions (up/down)
 *
 */
class sfUserAdminAdvancedUserForm extends sfUserAdvancedUserForm
{
  /**
   * configure
   * Configures the form to add the updated and created information as plain text
   *
   */
  public function configure()
  {
    parent::configure();

    $this->widgetSchema['created_at'] = new sfWidgetFormPlain();
    $this->widgetSchema['created_by_user_id'] = new sfWidgetFormPlain();
    $this->widgetSchema['updated_at'] = new sfWidgetFormPlain();
    $this->widgetSchema['updated_by_user_id'] = new sfWidgetFormPlain();
  }

  /**
   * updateCreatedAtColumn
   * Overrides the method for updating the column to return false and remove from the cleaned values array
   *
   * @return boolean Always false
   */
  public function updateCreatedAtColumn() { return false; }

  /**
   * updateCreatedByColumn
   * Overrides the method for updating the column to return false and remove from the cleaned values array
   *
   * @return boolean Always false
   */
  public function updateCreatedByUserIdColumn() { return false; }

  /**
   * updateUpdatedAtColumn
   * Overrides the method for updating the column to return false and remove from the cleaned values array
   *
   * @return boolean Always false
   */
  public function updateUpdatedAtColumn() { return false; }

  /**
   * updateUpdatedByColumn
   * Overrides the method for updating the column to return false and remove from the cleaned values array
   *
   * @return boolean Always false
   */
  public function updateUpdatedByUserIdColumn() { return false; }
}
