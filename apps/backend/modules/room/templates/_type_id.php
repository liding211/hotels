<?php
    if(!isset($filters)){
        echo select_tag( 'hotels_room[type_id]', 
            options_for_select( HotelsRoomTypeTable::getRoomTypeList(), $hotels_room->type_id ) ); 
    } else {
        echo select_tag( 'filters[type_id]', 
            options_for_select( HotelsRoomTypeTable::getRoomTypeList(), 
                isset($filters['type_id']) ? $filters['type_id'] : '' ) );         
    }
?>
