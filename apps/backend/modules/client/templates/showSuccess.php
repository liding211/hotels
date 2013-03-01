<div>
    <p><b>Client id:</b> <?php echo $hotels_client->id; ?></p>
    <p><b>Client name:</b> <?php echo $hotels_client->full_name; ?></p>
    <p><b>Client e-mail:</b> <?php echo $hotels_client->email; ?></p>
    <p><b>Client phone:</b> <?php echo $hotels_client->phone; ?></p>
</div>
<?php 
    echo link_to('list', 'client') . '&nbsp;';
    echo link_to('edit', 'client/edit?id=' . $hotels_client->id) . '&nbsp';
    echo link_to('delete', 'client/delete?id=' . $hotels_client->id);
?>