<?php 
    use_helper('Javascript');
    
    echo input_tag($input_name, 
        isset($selected_value) ? 
        $selected_value : '');
    
    echo javascript_tag('
         $( "#'.$jquery_identifier.'" ).autocomplete({
            source: "'.url_for('client/get_email_list', true).'",
            minLength: 2
         });
        '
    );
?>

