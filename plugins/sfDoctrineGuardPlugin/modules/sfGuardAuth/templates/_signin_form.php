<?php use_helper('Validation', 'I18N') ?>
<?php if (count($sf_request->getErrors()) > 0): ?>
<div class = "error-message">
  <p>Please fix the following errors:</p>
  <ul>
    <?php foreach($sf_request->getErrors() as $k => $v): ?>
    <li><?=__($v)?></li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>
<span class="admin-logo<?=(PROJECT == 'ouffer' ? '-ouf' : '')?>"></span>
<div id="login_block<?=(PROJECT == 'ouffer' ? '_ouf' : '')?>">
  <?=form_tag('@sf_guard_signin')?>
    <span class="table_row">
      <span class="label"><?php echo __('username'); ?>:</span>
      <span class="field"><?php echo input_tag('username', $sf_data->get('sf_params')->get('username')) ?></span>
    </span>
    <span class="table_row">
      <span class="label"><?php echo __('password'); ?>:</span>
      <span class="field"><?php echo input_password_tag('password') ?></span>
    </span>
    <span class="table_row">
	  <span class="label"><?php echo __('Remember me?'); ?></span>
	  <?php echo checkbox_tag('remember')?>
   	</span>
    <span class="table_save_menu">            
      <input type="image" src="/images/backend/admin-btn.png" value="login" alt="Submit now" name="submit">
    </span>
  </form>
</div>