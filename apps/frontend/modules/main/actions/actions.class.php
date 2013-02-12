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
        $this->a = 109;
        $this->b = 5;
        $this->d = 0;
        if($this->d === 0){
            $this->result = 0;
        }else{
            $this->result = ($this->a + $this->b) / $this->d;
        }
    }

    public function stashed(){
        $var = 'master branch';
    }

    private function stashedFunction(){
        $var = 'stashed this function!';
    }

    public function executeFormAction(){
    }
}
