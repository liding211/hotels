<?php
    include_partial('global/autocomplete_email', 
        array( 'input_name' => 'filters[email]', 
        'jquery_identifier' => 'filters_email',
        'selected_value' => isset($filters['email']) ? $filters['email'] : ''));
?>