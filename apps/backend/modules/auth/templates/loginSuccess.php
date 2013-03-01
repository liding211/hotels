<? if($sf_request->hasError('login')): ?>
<?= $sf_request->getError('login') ?>
<? endif ?>

<?php if ($sf_params->has('user')): ?>
  <p>Hello, <?php echo $sf_params->get('user') ?>!</p>
<?php endif; ?>

<span class=""></span>
<div id="">
   <form method="post" action="<?=$sf_request->getUri();?>">
            <span class="table_row">
                <span class="label">Username:</span>
                <span class="field"><input type="text" name="login" id="login" /></span>
            </span>
            <span class="table_row">
                <span class="label">Password:</span>
                <span class="field"><input type="password" name="password" id="password" /></span>
            </span>
            <span class="table_save_menu">
            
            <INPUT TYPE="image" SRC="/images/backend/admin-btn.png" VALUE="login" ALT="Submit now" name="submit">
        </span>
		</form>
</div>
