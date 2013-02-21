<?php $type_list = roomActions::getRoomTypeList(); ?>
<?php echo select_tag('hotels_room[type_id]', array($type_list)) ?>
