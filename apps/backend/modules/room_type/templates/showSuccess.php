<?php
// auto-generated by sfDoctrineAdmin
// date: 2013/02/15 16:31:19
?>
<table>
<tbody>
<tr>
<th>Id: </th>
<td><?php echo $hotels_room_type->getid() ?></td>
</tr>
<tr>
<th>Type: </th>
<td><?php echo $hotels_room_type->gettype() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to('edit', 'room_type/edit?id='.$hotels_room_type->id) ?>
&nbsp;<?php echo link_to('list', 'room_type/list') ?>