<?php

/**
 * order actions.
 *
 * @package    sf_sandbox
 * @subpackage order
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class orderActions extends sfActions{
    
    public function validateMakeOrder(){
        if($this->getRequest()->getMethod() == sfRequest::POST){
            $from = $this->getRequestParameter('from');
            $to = $this->getRequestParameter('to');
            $id = (int) $this->getRequestParameter('id', 0);
            if(!empty($from) && !empty($to)){
                if(strtotime($from) > strtotime($to)){
                    $this->getRequest()->setError(
                        'Date range', 
                        'An incorrect search date range'
                    );
                }
                if($to < date("Y-m-d")){
                    $this->getRequest()->setError(
                        'End date', 
                        'Ending of the search range is incorrect'
                    );
                }
                if($from < date("Y-m-d")){
                    $this->getRequest()->setError(
                        'Start date', 
                        'Beginning of the search range is incorrect'
                    );
                }
                
                $is_room_free = HotelsRoom::isRoomFree($from, $to, $id);
                if(empty($is_room_free)){
                    $this->getRequest()->setError(
                        'Room', 
                        'During this period of time - the room is reserved'
                    );
                }
            }else{
                $this->getRequest()->setError(
                    'Date range', 
                    'Reservation date not specified'
                );
            }
        }
        return !$this->getRequest()->hasErrors();
    }
    
    public function executeMakeOrder(){
        $room_id = $this->getRequestParameter('id', 0);
        
        $order = new HotelsReservation();
        
        $order->set('client_id', $this->getUser()->getAttribute('client[id]'));
        $order->set('room_id', $room_id);
        
        $json['result'] = !$this->getRequest()->hasErrors();
        $json['error'] = '';
        $json['from'] = $this->getRequestParameter('from');
        $json['to'] = $this->getRequestParameter('to');
        $json['order_info'] = '';
        
        $this->renderText(json_encode($json));
        return sfView::NONE;
    }
    
    public function handleErrorMakeOrder() {
        $json['result'] = !$this->getRequest()->hasErrors();
        $json['error'] = $this->getRequest()->getErrors();
        $json['from'] = $this->getRequestParameter('from');
        $json['to'] = $this->getRequestParameter('to');
        $json['order_info'] = '';
        
        $this->renderText(json_encode($json));
        return sfView::NONE;
    }
}
