<?php 
    include_partial('global/autocomplete_email', 
        array( 'input_name' => 'client[email]', 
        'jquery_identifier' => 'client_email',
        'selected_value' => $hotels_reservation->HotelsClient->email));
?>