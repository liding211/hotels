<?php 
    echo input_hidden_tag('hotels_reservation[client_id]', $hotels_reservation->client_id);
    
    include_partial('global/autocomplete_email', 
        array( 'input_name' => 'client_email', 
        'jquery_identifier' => 'client_email',
        'selected_value' => isset($hotels_reservation->HotelsClient->email) ? 
            $hotels_reservation->HotelsClient->email : '' ,
        'hidden_value_field' => 'hotels_reservation_client_id'));
?>