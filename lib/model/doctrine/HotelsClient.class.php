<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HotelsClient extends BaseHotelsClient{
    public function getFullName(){
        return $this->first_name . ' ' . $this->last_name;
    }
}
