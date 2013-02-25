<?php
    
    use_helper('MoneyConvertor');
    
    $value = (isset($hotels_reservation->total)) ? 
        convertFromCents($hotels_reservation->total) . sfConfig::get('app_currency_sign') : '' ;
    
    $days = (strtotime($hotels_reservation->reserved_to) 
        - strtotime($hotels_reservation->reserved_from)) / 86400;
    //echo $days;
    
    echo $value;
    
//    echo javascript_tag('
//        $(document).ready(function(){
//            /*days = date($(\'#hotels_reservation_reserved_to\').val()[0]) 
//                - date($(\'#hotels_reservation_reserved_from\').val()[0]);*/
//            alert($(\'#hotels_reservation_reserved_from\').val()[0]);
//        });
//        
//        days = strtotime(date("Y-m-d H:i:s")) - strtotime(date("Y-m-d H:i:s"));
//    ');
?>
