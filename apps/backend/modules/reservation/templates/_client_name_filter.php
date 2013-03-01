<?php 
echo input_tag('filters[client_name]', 
    isset($filters['client_name']) ? $filters['client_name'] : '' ); 
?>
