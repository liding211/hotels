<?php

/**
 * main actions.
 *
 * @package    sf_sandbox
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mainActions extends sfActions{
  /**
   * Executes index action
   *
   */
  public function executeIndex(){
    $this->text = 'hi guys!';
    $this->description = 'This is test text!';
  }
  
  public function executeMyAction(){
      $a = 2;
      $b = 3;
      $this->result = $a + $b;
  }
  
  public function executeFormAction(){
  }
}
