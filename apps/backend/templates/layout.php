<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<?php use_javascript('http://code.jquery.com/jquery-1.9.1.js') ?>
<?php use_javascript('http://code.jquery.com/ui/1.10.1/jquery-ui.js') ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<?php include_partial('global/main_menu') ?>

<? if($sf_flash->has('error')): ?>
<p style="color: red; font-weight: bolder; font-size: 18px;"><?= $sf_flash->get('error') ?></p>
<? endif ?>
<? if($sf_flash->has('warning')): ?>
<p style="color: red; font-size: 16px;"><?= $sf_flash->get('warning') ?></p>
<? endif ?>
<? if($sf_flash->has('message')): ?>
<p style="color: green; font-weight: bold; font-size: 18px;"><?= $sf_flash->get('message') ?></p>
<? endif ?>
    
<?php echo $sf_data->getRaw('sf_content') ?>
    
</body>
</html>
