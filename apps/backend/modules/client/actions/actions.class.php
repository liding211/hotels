<?php
// auto-generated by sfDoctrineAdmin
// date: 2013/02/15 16:31:52
?>
<?php

/**
 * client actions.
 *
 * @package    sf_sandbox
 * @subpackage client
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Olivier Verdier <Olivier.Verdier@gmail.com>
 * @version    SVN: $Id: actions.class.php 5639 2007-10-23 14:27:18Z Eric.Fredj $
 */
class clientActions extends sfActions
{
  public function executeIndex ()
  {
    return $this->forward('client', 'list');
  }

  public function executeList ()
  {
  	$this->hotels_clients = Doctrine::getTable('HotelsClient')->findAll();
  }

  public function executeShow ()
  {
    $this->hotels_client = Doctrine::getTable('HotelsClient')->find($this->getRequestParameter('id'));    
    $this->forward404Unless($this->hotels_client);
  }

  public function executeCreate ()
  {
    $this->hotels_client = new HotelsClient();
    $this->setTemplate('edit');
  }

  public function executeEdit ()
  {
    $this->hotels_client = Doctrine::getTable('HotelsClient')->find($this->getRequestParameter('id'));    
    $this->forward404Unless($this->hotels_client);
  }

  public function executeDelete ()
  {
    $this->hotels_client = Doctrine::getTable('HotelsClient')->find($this->getRequestParameter('id'));    
    
    $this->forward404Unless($this->hotels_client);

    try
    {
      $this->hotels_client->delete();
      $this->redirect('client/list');
    }
    catch (Doctrine_Exception $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Hotels client. Make sure it does not have any associated items.');
      return $this->forward('client', 'list');
    }
  }

  public function executeUpdate ()
  {
    if (!$this->getRequestParameter('id'))
    {
      $hotels_client = new HotelsClient();
    }
    else
    {
      $hotels_client = Doctrine::getTable('HotelsClient')->find($this->getRequestParameter('id'));
      $this->forward404Unless($hotels_client);
    }

    $formData = $this->getRequestParameter('hotels_client');
    if ($newValue = $formData['first_name'])
    {
	     $hotels_client->set('first_name', $newValue);
    }
    if ($newValue = $formData['last_name'])
    {
	     $hotels_client->set('last_name', $newValue);
    }
    if ($newValue = $formData['email'])
    {
	     $hotels_client->set('email', $newValue);
    }
    if ($newValue = $formData['phone'])
    {
	     $hotels_client->set('phone', $newValue);
    }

    $hotels_client->save();

    return $this->redirect('client/show?id='.$hotels_client->id);
  }
}