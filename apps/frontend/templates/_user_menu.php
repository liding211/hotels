<?php
    echo 'Welcom ' . $sf_user->getAttribute('client[first_name]') . ' ';
    echo link_to("Logout", '@logout'); 
?>