<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!-- Coded by Yair Silbermintz - yair[at]silbermintz.com -->
<!-- This site was designed to be accessible as possible. If you are experiencing problems using/viewing the site, please email me and I will do my best to address them -->
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>
        <?php   if (!include_slot('title')){
			echo sfConfig::get('app_title');
		}       ?>
    </title>

    <?php /* <link rel="shortcut icon" href="/favicon.ico" /> */ ?>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/reset/reset-min.css" />
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.0r4/build/fonts/fonts-min.css" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
</head>

<body>
	<?php if ($sf_user->hasFlash('notice')): ?>
		<div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
	<?php endif ?>
	<?php if ($sf_user->hasFlash('error')): ?>
		<div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
	<?php endif ?>
	<?php echo $sf_content ?>
</body>
</html>