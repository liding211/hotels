<?php
// auto-generated by sfDoctrineAdmin
// date: 2013/02/15 16:31:08
?>
<?php

/**
 * room actions.
 *
 * @package    sf_sandbox
 * @subpackage room
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Olivier Verdier <Olivier.Verdier@gmail.com>
 * @version    SVN: $Id: actions.class.php 5639 2007-10-23 14:27:18Z Eric.Fredj $
 */
class roomActions extends sfActions
{
  public function executeIndex ()
  {
    return $this->forward('room', 'list');
  }

  public function executeList ()
  {
  	$this->hotels_rooms = Doctrine::getTable('HotelsRoom')->findAll();
  }

  public function executeShow ()
  {
    $this->hotels_room = Doctrine::getTable('HotelsRoom')->find($this->getRequestParameter('id'));    
    $this->forward404Unless($this->hotels_room);
  }

  public function executeCreate ()
  {
    $this->hotels_room = new HotelsRoom();
    $this->setTemplate('edit');
  }

  public function executeEdit ()
  {
    $this->hotels_room = Doctrine::getTable('HotelsRoom')->find($this->getRequestParameter('id'));    
    $this->forward404Unless($this->hotels_room);
  }

  public function executeDelete ()
  {
    $this->hotels_room = Doctrine::getTable('HotelsRoom')->find($this->getRequestParameter('id'));    
    
    $this->forward404Unless($this->hotels_room);

    try
    {
      $this->hotels_room->delete();
      $this->redirect('room/list');
    }
    catch (Doctrine_Exception $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Hotels room. Make sure it does not have any associated items.');
      return $this->forward('room', 'list');
    }
  }

  public function executeUpdate ()
  {
    if (!$this->getRequestParameter('id'))
    {
      $hotels_room = new HotelsRoom();
    }
    else
    {
      $hotels_room = Doctrine::getTable('HotelsRoom')->find($this->getRequestParameter('id'));
      $this->forward404Unless($hotels_room);
    }

    $formData = $this->getRequestParameter('hotels_room');
    if ($newValue = $formData['HotelsRoomType'])
    {
       $hotels_room->set('type_id', (empty($newValue) ? null : $newValue));
    }
    if ($newValue = $formData['price'])
    {
	     $hotels_room->set('price', $newValue);
    }
    if ($newValue = $formData['photo'])
    {
	     $hotels_room->set('photo', $newValue);
    }

    $hotels_room->save();

    return $this->redirect('room/show?id='.$hotels_room->id);
  }
}
