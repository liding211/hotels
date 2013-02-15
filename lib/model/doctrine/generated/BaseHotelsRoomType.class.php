<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseHotelsRoomType extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('hotels_room_type');
    $this->hasColumn('type', 'string', 255, array('type' => 'string', 'notnull' => true, 'unique' => true, 'length' => '255'));
  }

  public function setUp()
  {
    $this->hasMany('HotelsReservation', array('local' => 'id',
                                              'foreign' => 'room_id'));

    $this->hasMany('HotelsRoom', array('local' => 'id',
                                       'foreign' => 'type_id'));
  }
}