<?php
    use_helper('Javascript');

    echo input_tag('filters[email]', isset($filters['email']) ? $filters['email'] : '');
    
    echo javascript_tag('
         $( "#filters_email" ).autocomplete({
            source: "'.url_for('client/get_email_list', true).'",
            minLength: 2
         });
        '
    );
?>
