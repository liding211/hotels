<?php if(array_intersect($_SESSION['symfony/user/sfUser/credentials'], array('admin'))): ?>
    <div id="menu">
        <?php echo link_to('Room', 'room'); ?>&nbsp;
        <?php echo link_to('Type of room', 'room_type'); ?>&nbsp;
        <?php echo link_to('Our client', 'client'); ?>&nbsp;
        <?php echo link_to('List of the order', 'reservation'); ?>
        <?php echo link_to('Logout', 'auth/Logout'); ?>
    </div>
<?php endif; ?>
