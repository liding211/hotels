<?php
// auto-generated by sfDoctrineAdmin
// date: 2011/11/30 10:55:45
?>
    <td><?php echo link_to($sf_guard_user_login->user_id ? $sf_guard_user_login->user_id : __('-'), 'sfGuardUser/edit?id='.$sf_guard_user_login->user_id) ?></td>
    <td><?php echo $sf_guard_user_login->user->email ?></td>
      <td><?php echo $sf_guard_user_login->ip ?></td>
      <td><?php echo ($sf_guard_user_login->created_at !== null && $sf_guard_user_login->created_at !== '') ? format_date($sf_guard_user_login->created_at, "f") : '' ?></td>
  