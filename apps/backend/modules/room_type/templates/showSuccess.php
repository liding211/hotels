<div>
    <p><b>Room type id:</b> <?php echo $hotels_room_type['id']; ?></p>
    <p><b>Room type:</b> <?php echo $hotels_room_type['type']; ?></p>
</div>
<?php
    echo link_to('list', 'room_type') . '&nbsp;';
    echo link_to('edit', 'room_type/edit?id=' . $hotels_room_type->id) . '&nbsp;';
    echo link_to('delete', 'room_type/delete?id=' . $hotels_room_type->id) . '&nbsp;';
?>