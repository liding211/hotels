<?php
// auto-generated by sfDoctrineAdmin
// date: 2012/01/03 10:07:55
?>
<ul class="sf_admin_actions">
  <li><?php if($sf_user->getGuardUser()->getIsSuperAdmin()) { echo button_to(__('list'), 'sfGuardUser/list?id='.$sf_guard_user->id, array (
  'class' => 'sf_admin_action_list',
)); } ?></li>
  <li><?php echo submit_tag(__('save'), array (
  'name' => 'save',
  'class' => 'sf_admin_action_save',
)) ?></li>
  <li><?php if($sf_user->getGuardUser()->getIsSuperAdmin()) { echo submit_tag(__('save and add'), array (
  'name' => 'save_and_add',
  'class' => 'sf_admin_action_save_and_add',
)); } ?></li>
</ul>