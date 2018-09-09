<!DOCTYPE html>
<html>
<!-- Main Global Page Template [Admin] -->
<head>
<meta http-equiv="Content-Language" content="uk" />
<meta name="GENERATOR" content="Zend Eclipse PDT" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<?php
if (Auth::instance()->logged_in()) {
?>
<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
		<div class="nav-collapse collapse">
				<a class="brand" href="<?php echo URL::site("main")?>"><?php echo $title?></a>
				<ul class="nav">
					
					<!-- Категорії -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<?php echo __("Categories");?>
							<b class="caret"></b>
						</a>
						<!-- Submenu list start -->
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li><a href="<?php echo URL::site('categories/categories')?>"><?php echo __("List of categories");?></a></li>
							<li><a href="<?php echo URL::site('categories/categories/add')?>"><?php echo __("Add new category");?></a></li>
						</ul>
						<!-- /Submenu list end -->
					</li>
					<!-- /Категорії -->
					
					<li class="divider-vertical"></li>
					
					<!-- Активності -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<?php echo __("Activities")?>
							<b class="caret"></b>
						</a>
						<!-- Submenu list start -->
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li><a href="<?php echo URL::site('activities/activities')?>"><?php echo __("List of transactions")?></a></li>
							<li><a href="<?php echo URL::site('activities/activities/add')?>"><?php echo __("Add new transaction")?></a></li>
							<li><a href="<?php echo URL::site('activities/activities/search')?>"><?php echo __("Search transactions")?></a></li>
							
							<!-- Sumbenu Orders -->
							<li class="dropdown-submenu">
								<a tabindex="-1" href="#"><?php echo __("Reports")?></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo URL::site('activities/orders/index')?>"><?php echo __("Report Generator")?></a></li>
									<li><a href="<?php echo URL::site('activities/orders/fullreportbyyears')?>"><?php echo __("Full Report By Years")?></a></li>
								</ul>
							</li>
							<!-- /Submenu Orders -->
							
						</ul>
						<!-- /Submenu list end -->
					</li>
					<!-- /Активності -->
					
					<li class="divider-vertical"></li>
										
					<!-- Довідка -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							Допомога
							<b class="caret"></b>
						</a>
						<!-- Submenu list start -->
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li><a href="#">Довідка</a></li>
							<li><a href="<?php echo URL::site('help/about')?>"><?php echo __("About...")?></a></li>
						</ul>
						<!-- /Submenu list end -->
					</li>
					
					<li class="divider-vertical"></li>
					
					<!-- User Dropdown submenu -->
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="icon-user"></i>&nbsp;<?php echo Auth::instance()->get_user()?>
							<b class="caret"></b>
						</a>
						<!-- Submenu list start -->
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<li><a href="<?php echo URL::site('login/logout')?>"><?php echo __("Exit")?></a></li>
						</ul>
						<!-- /Submenu list end -->
					</li>
					
				</ul>
			</div><!--/.nav-collapse -->
	</div><!-- /.navbar-inner -->
</div> <!--/.navbar  -->
<?php
}
?>

<!-- Content Container -->
<div class="container-fluid"  style="padding-top: 50px">
	<?php echo "{$content}\n";?>
</div>
<!-- /Content Container -->

</body>
<!-- /Main Global Page Template -->
</html>