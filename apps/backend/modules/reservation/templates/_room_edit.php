<?php
    $rooms = HotelsRoomTable::getRoomList();
    echo javascript_tag("
        rooms_price = ".json_encode($rooms['price']).";
    ");
    echo select_tag( 'hotels_reservation[room_id]', 
        options_for_select( $rooms['list'], 
            (int) $hotels_reservation->id > 0 ? 
                $hotels_reservation->room_id : 
                $sf_request->getParameter('hotels_reservation[room_id]')),
        array('multiple' => empty($hotels_reservation->id)));
?>
