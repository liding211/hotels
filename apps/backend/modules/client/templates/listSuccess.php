<?php
// auto-generated by sfDoctrineAdmin
// date: 2013/02/15 16:31:52
?>
<h1>client</h1>

<table>
<thead>
<tr>
  <th>Id</th>
  <th>First name</th>
  <th>Last name</th>
  <th>Email</th>
  <th>Phone</th>
  <th>Created at</th>
  <th>Updated at</th>
</tr>
</thead>
<tbody>
<?php foreach ($hotels_clients as $hotels_client): ?>
<tr>
    <td><?php echo link_to($hotels_client->get('id'), 'client/show?id='.$hotels_client->id); ?></td>
      <td><?php echo $hotels_client->get('first_name'); ?></td>
      <td><?php echo $hotels_client->get('last_name'); ?></td>
      <td><?php echo $hotels_client->get('email'); ?></td>
      <td><?php echo $hotels_client->get('phone'); ?></td>
      <td><?php echo $hotels_client->get('created_at'); ?></td>
      <td><?php echo $hotels_client->get('updated_at'); ?></td>
  </tr>
<?php endforeach; ?>
<tr><td>Number of hotels_clients: <?php echo count($hotels_clients) ?></td></tr>
</tbody>
</table>

<?php echo link_to ('create', 'client/create') ?>
