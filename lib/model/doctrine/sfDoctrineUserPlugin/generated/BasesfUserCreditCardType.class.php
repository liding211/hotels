<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasesfUserCreditCardType extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('sf_user_credit_card_type');
    $this->hasColumn('is_accepted', 'boolean', null, array('type' => 'boolean'));
    $this->hasColumn('code', 'string', 1, array('type' => 'string', 'length' => 1));
    $this->hasColumn('abbreviation', 'string', 5, array('type' => 'string', 'length' => 5));
    $this->hasColumn('name', 'string', 20, array('type' => 'string', 'length' => 20));
  }

  public function setUp()
  {
    $this->hasMany('sfUserBilling', array('local' => 'id',
                                          'foreign' => 'credit_card_type_id'));

    $timestampable0 = new Doctrine_Template_Timestampable();
    $userstampable0 = new Userstampable();
    $this->actAs($timestampable0);
    $this->actAs($userstampable0);
  }
}