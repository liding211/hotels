<?php if($sf_user->isAuthenticated()): ?>
    <div id="menu">
        <?php echo link_to('Rooms', 'room'); ?>&nbsp;
        <?php echo link_to('Room types', 'room_type'); ?>&nbsp;
        <?php echo link_to('Clients', 'client'); ?>&nbsp;
        <?php echo link_to('Bookings', 'reservation'); ?>&nbsp;
        <?php echo link_to('Logout', 'auth/Logout'); ?>
    </div>
<?php endif; ?>

