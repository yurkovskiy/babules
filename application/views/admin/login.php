<!DOCTYPE html>
<html>
<!-- Main Global Page Template [Admin] -->
<head>

<meta http-equiv="Content-Language" content="uk" />
<meta name="GENERATOR" content="Zend Studio" />
<meta charset="utf-8" />
<meta name="description" content="<?php echo $description?>">
<title><?php echo "{$title}"; ?></title>

<?php foreach ($styles as $style): ?>
<link rel="stylesheet" type="text/css" href="<?php echo URL::base();?>public/bootstrap/css/<?php echo $style ?>.css">
<?php endforeach; ?>
<link rel="shortcut icon" href="<?php echo URL::base();?>public/images/favicon.ico">
<script type="text/javascript" src="<?php echo URL::base();?>public/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo URL::base();?>public/bootstrap/js/bootstrap.min.js"></script>
</head>

<body>

<!-- Container -->
<div class="container">
	<!-- Content -->
	<?php echo $content ?>
	<!-- /Content -->
</div>
<!-- /Container -->
</body>
<!-- /Main Global Page Template -->
</html>