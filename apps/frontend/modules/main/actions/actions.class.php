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
        $this->text = 'Hi people!';
        $this->description = 'This is test text! We have cookies!';
    }

    public function executeMyAction(){
        $this->result = sqrt(44) - cos(45) * abs(-55);
    }
}
