<div>
    <p><b>Client id:</b> <?php echo $hotels_client['id']; ?></p>
    <p><b>First name:</b> <?php echo $hotels_client['first_name']; ?></p>
    <p><b>Last name:</b> <?php echo $hotels_client['last_name']; ?></p>
    <p><b>E-mail:</b> <?php echo $hotels_client['email']; ?></p>
    <p><b>Phone:</b> <?php echo $hotels_client['phone']; ?></p>
</div>
<?php 
    echo link_to('list', 'client') . '&nbsp;';
    echo link_to('edit', 'client/edit?id=' . $hotels_client->id) . '&nbsp';
    echo link_to('delete', 'client/delete?id=' . $hotels_client->id);
?>