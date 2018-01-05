<?php defined('SYSPATH') or die('No direct script access.'); ?>
<!DOCTYPE html>
<html>
     <head>
        <meta http-equiv="content-type" content="text/html; charset=utf8" />
        <meta name="author" content="Yuriy Bezgchnyuk" />
        <title><?php echo $title ?></title>
        <?php foreach ($styles as $style): ?>
		<link rel="stylesheet" type="text/css" href="<?php echo URL::base();?>public/bootstrap/css/<?php echo $style ?>.css">
		<?php endforeach; ?>
		<link rel="shortcut icon" href="<?php echo URL::base();?>public/images/favicon.ico">
    </head>
 
    <body>
        <div class="container">
            <div class="alert alert-error">
            	<h4><?php echo $title?></h4>
            	<span><?php echo $message?></span>
            	<h3><a class="btn btn-primary" href="<?php echo $url?>">Головна сторінка</a></h3>
            </div>
        </div>
    </body>
</html>