<div id="menu">
    <ul>
        <?php foreach($menu as $url): ?>
            <?php echo $url(); ?>
        <?php endforeach; ?>
    </ul>
</div>