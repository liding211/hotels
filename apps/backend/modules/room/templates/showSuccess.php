<?php use_helper('MoneyConvertor'); 
?>
<div>
    <p>Room id: <?php echo $hotels_room['id'] ?></p>
    <p>Room type: <?php echo $hotels_room['HotelsRoomType']['type'] ?></p>
    <p>Room price: <?php echo convertFromCents($hotels_room['price']) ?></p>
    <p>Room photo: <?php echo $hotels_room['photo'] ?></p>
    <p>Room create date: <?php echo $hotels_room['created_at'] ?></p>
    <p>Room update date: <?php echo $hotels_room['updated_at'] ?></p>
</div>
<?php echo link_to('list', 'room'); ?>&nbsp;
<?php echo link_to('edit', 'room/edit?id=' . $hotels_room['id']); ?>&nbsp;
<?php echo link_to('delete', 'room/delete?id=' . $hotels_room['id']); ?>