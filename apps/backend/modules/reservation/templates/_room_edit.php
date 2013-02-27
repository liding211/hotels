<?php
    $rooms = HotelsRoomTable::getRoomList();
    echo javascript_tag("
        rooms_price = ".json_encode($rooms['price']).";
    ");
    echo select_tag( 'hotels_reservation[room_id]', 
        options_for_select( $rooms['list'], 
            isset($hotels_reservation->room_id) ? $hotels_reservation->room_id : ''),
        array('multiple' => empty($hotels_reservation->id) ? true : false));
?>
