<?php 
    use_helper('Javascript');
    
    echo input_tag($input_name, $selected_value);
    
    $js_insert_hidden_value = isset($hidden_value_field) ? 
        '$( "#'.$hidden_value_field.'" ).val( ui.item.value );' : '' ;
    echo javascript_tag('
         $( "#'.$jquery_identifier.'" ).autocomplete({
            source: "'.url_for('client/get_email_list', true).'",
            minLength: 2,
            focus: function( event, ui ) {
                $( "#'.$jquery_identifier.'" ).val( ui.item.label );
                return false;
            },
            select: function( event, ui ) {
                $( "#'.$jquery_identifier.'" ).val( ui.item.label );
                '.$js_insert_hidden_value.'
                return false;
            }
         });
        '
    );
?>

