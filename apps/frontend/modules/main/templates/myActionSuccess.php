<?php echo link_to('Home', '/'); ?>
<p style="font-size: 25px;">The sum of <?php echo $a; ?> plus <?php echo $b; ?> dividing 
    <?php echo $d; ?> is <?php echo $result; ?></p>
<p>Test form</p>
<form action="main/formAction">
    <?php echo label_for('name', 'Name:'); ?><br />
    <?php echo input_tag('name'); ?><br />
    <?php echo label_for('about_you', 'Tell us about yourself:'); ?><br />
    <?php echo textarea_tag('about_you'); ?><br />
    <?php echo submit_tag('Ok'); ?>
</form>
