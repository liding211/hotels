<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseHotelsAdmin extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('hotels_admin');
    $this->hasColumn('email', 'string', 255, array('type' => 'string', 'notnull' => true, 'unique' => true, 'length' => '255'));
    $this->hasColumn('password', 'string', 255, array('type' => 'string', 'notnull' => true, 'unique' => true, 'length' => '255'));
    $this->hasColumn('created_at', 'timestamp', null, array('type' => 'timestamp', 'notnull' => true));
    $this->hasColumn('updated_at', 'timestamp', null, array('type' => 'timestamp', 'notnull' => true));
  }

}