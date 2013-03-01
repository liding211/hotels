<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */



class HotelsRoomTable extends Doctrine_Table{
        
    public static function getRoomList(){
        
        $room_list = array();
        $room_numbers = Doctrine_Manager::connection()->fetchAll('
            SELECT r.id, r.number, r.price, t.type FROM hotels_room r 
            INNER JOIN hotels_room_type t ON r.type_id = t.id');
        foreach($room_numbers as $room_number){
            $room_info['list'][$room_number['id']] = $room_number['number'] 
                . ' - ' . $room_number['type'] . ' - ' 
                . MoneyConvertor::fromCents($room_number['price']) 
                . sfConfig::get('app_currency_sign');
            $room_info['price'][$room_number['id']] = $room_number['price'];
        }
        return $room_info;
    }
}
