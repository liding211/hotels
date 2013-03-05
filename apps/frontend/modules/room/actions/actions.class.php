<?php

/**
 * room actions.
 *
 * @package    sf_sandbox
 * @subpackage room
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class roomActions extends sfActions{
    /**
     * Executes index action
     *
     */
    public function executeIndex(){
        return sfView::SUCCESS;
    }
    
    public function executeShow(){
        return sfView::SUCCESS;
    }
    
    public function validateGetRoomsList(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $from = $this->getRequestParameter('from');
            $to = $this->getRequestParameter('to');
            if(!empty($from) OR !empty($to)){
                if($to < date("Y-m-d")){
                    $this->getRequest()->setError(
                        'End date', 
                        'Ending of the search range is incorrect'
                    );
                }
                if(strtotime($from) > strtotime($to)){
                    $this->getRequest()->setError(
                        'Date range', 
                        'An incorrect search date range'
                    );
                }
                if($from < date("Y-m-d")){
                    $this->getRequest()->setError(
                        'Start date', 
                        'Beginning of the search range is incorrect'
                    );
                }
                if(empty($to)){
                    $this->getRequest()->setError(
                        'End date', 
                        'Enter the end date search'
                    );
                }
                if(empty($from)){
                    $this->getRequest()->setError(
                        'Start date', 
                        'Enter the start date of search'
                    );
                }
            }
        }
        return !$this->getRequest()->hasErrors();
    }
    
    public function validateShow(){
        if($this->getRequest()->getMethod() == sfRequest::GET){
            $room_id = (int) $this->getRequestParameter('id', 0);
            $this->room = HotelsRoomTable::getRoomById($room_id);
            if(empty($this->room)){
                $this->getRequest()->setError(
                    'Room', 
                    'Room with specified id not found'
                );
            }
        }
        return !$this->getRequest()->hasErrors();
    }

    public function executeGetRoomsList(){
        $room = new HotelsRoom();
        
        $from = $this->getRequestParameter('from', '');
        $to = $this->getRequestParameter('to', '');
        
        $rooms = $room->getList($from, $to); //$room->getAllRooms();
        foreach($rooms as $room){
            $list[] = array(
                'id' => $room->id, 
                'number' => $room->number,
                'price' => $room->price,
                'type' => $room->HotelsRoomType->type,
                'photo' => $room->photo
            );
        }

        $json['result'] = !$this->getRequest()->hasErrors();
        $json['error'] = '';
        $json['from'] = $this->getRequestParameter('from');
        $json['to'] = $this->getRequestParameter('to');
        $json['rooms'] = $list;

        $this->renderText(json_encode($json));
        return sfView::NONE;
    }
    
    public function handleErrorGetRoomsList() {
        $json['result'] = !$this->getRequest()->hasErrors();
        $json['error'] = $this->getRequest()->getErrors();
        $json['from'] = $this->getRequestParameter('from');
        $json['to'] = $this->getRequestParameter('to');
        $json['rooms'] = '';

        $this->renderText(json_encode($json));
        return sfView::NONE;
    }
    
    public function handleErrorShow() {
        $this->redirect404();
    }
}
