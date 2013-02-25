<?php 
    use_helper('Javascript');
    
    echo input_tag($input_name, 
        isset($selected_value) ? 
        $selected_value : '');
    
    $field = (isset($hidden_value_field)) ? 
        '$( "#'.$hidden_value_field.'" ).val( ui.item.value );' : '' ;
    echo javascript_tag('
         $( "#'.$jquery_identifier.'" ).autocomplete({
            source: "'.url_for('client/get_email_list', true).'",
            minLength: 2,
            select: function( event, ui ) {
                $( "#'.$jquery_identifier.'" ).val( ui.item.label );
                '.$field.'
                return false;
            }
         });
        '
    );
?>

