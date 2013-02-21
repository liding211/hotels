<div>
    <p><b>ID:</b> <?php echo $hotels_reservation->id; ?></p>
    <p><b>Client:</b> <?php echo $hotels_reservation->HotelsClient->full_name; ?></p>
    <p><b>Room:</b> <?php echo $hotels_reservation->HotelsRoom->HotelsRoomType->type; ?></p>
    <p><b>From:</b> <?php echo date('Y-m-d', strtotime($hotels_reservation->reserved_from)); ?>
    <b>to:</b> <?php echo date('Y-m-d', strtotime($hotels_reservation->reserved_to)); ?></p>
</div>
<?php 
    echo link_to('list', 'reservation') . '&nbsp;';
    echo link_to('edit', 'reservation/edit?id=' . $hotels_reservation->id) . '&nbsp';
    echo link_to('delete', 'reservation/delete?id=' . $hotels_reservation->id);
?>