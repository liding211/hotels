<?php 
    use_helper('Javascript');
    
    echo input_tag('client[email]', 
        isset($hotels_reservation->HotelsClient->email) ? 
        $hotels_reservation->HotelsClient->email : '');
    
    echo javascript_tag('
         $( "#client_email" ).autocomplete({
            source: "'.url_for('client/get_email_list', true).'",
            minLength: 2
         });
        '
    );
?>
