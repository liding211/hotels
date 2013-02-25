<?php
    if(!isset($hotels_reservation->room_id)){
        echo select_tag( 'hotels_reservation[room_id]', 
            options_for_select( HotelsRoomTable::getRoomList(), '' ) ); 
    } else {
        echo select_tag( 'hotels_reservation[room_id]', 
            options_for_select( HotelsRoomTable::getRoomList(), 
                isset($hotels_reservation->room_id) ? $hotels_reservation->room_id : '' ) );         
    }
?>
