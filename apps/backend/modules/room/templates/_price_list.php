<?php 
    use_helper('MoneyConvertor');
    echo convertFromCents($hotels_room->getPrice()) . sfConfig::get('app_currency_sign');
?>
