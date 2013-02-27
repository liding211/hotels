<?php
// regexp = '/([0-9\.]+)\$/'

    use_helper('MoneyConvertor');
    
    echo '<font id="total_price">' . convertFromCents($hotels_reservation->total) 
        . sfConfig::get('app_currency_sign') . '</font>';
    echo javascript_tag('
        
        setInterval( function () {
            if ($(\'#hotels_reservation_reserved_from\').val() != "" && $(\'#hotels_reservation_reserved_to\').val() != ""){
                getPrice();
            }}, 500
        );

        selected_items = new Array();
        
        function getPrice(){
            var total_price = 0;
            from = new Date($(\'#hotels_reservation_reserved_from\').val().replace(/(\d+)-(\d+)-(\d+)/, \'$2/$3/$1\'));
            to = new Date($(\'#hotels_reservation_reserved_to\').val().replace(/(\d+)-(\d+)-(\d+)/, \'$2/$3/$1\'));
            days = Math.round((to - from) / (86400 * 1000));
            
            if(!days || days < 0 || selected_items.length == 0){
                return;
            }
            
            for(var key = 0; key < selected_items.length; key++){
                total_price += rooms_price[selected_items[key]] * days;
            }
            
            $("#total_price").text((total_price / 100).toFixed(2) + \''.
            sfConfig::get('app_currency_sign')
            .'\');
        }
        
        $("#hotels_reservation_room_id").change( function(){
            selected_items = [];
            $("#hotels_reservation_room_id option:selected").each(function () {
                selected_items[selected_items.length] = $(this).val();
            });
            getPrice();
        })
    ');
?>