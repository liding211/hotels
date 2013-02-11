<p>Test form!</p>
<?php echo form_tag('main/formAction') ?>
  <?php echo label_for('name', 'What is your name?') ?>
  <?php echo input_tag('name') ?>
  <?php echo submit_tag('Ok') ?>
</form>