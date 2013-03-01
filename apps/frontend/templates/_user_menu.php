<?php
    echo 'Welcom ' . $sf_user->getAttribute('first_name') . ' ';
    echo link_to("Logout", '@logout'); 
?>