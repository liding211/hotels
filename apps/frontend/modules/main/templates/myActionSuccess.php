<p>The sum of 2 plus 3 is <?php echo $result; ?></p>
<p>Test form</p>
<?php echo form_tag('main/formAction'); ?>
  <?php echo label_for('name', 'Name:'); ?><br />
  <?php echo input_tag('name'); ?><br />
  <?php echo label_for('about_you', 'Tell us about yourself:'); ?><br />
  <?php echo textarea_tag('about_you'); ?><br />
  <?php echo submit_tag('Ok'); ?>
</form>