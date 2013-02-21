<?php
    use_helper('MoneyConvertor');
    echo convertFromCents($hotels_reservation->total) . sfConfig::get('app_currency_sign');
?>
