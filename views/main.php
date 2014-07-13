<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo $this->title; ?> &middot; <?php echo $this->app_name; ?></title>
	
	<!-- Bootstrap core CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap theme -->
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	
	<!-- Custom styles for this template -->
	<link href="assets/css/theme.css" rel="stylesheet">
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<!-- Main Navigation (fixed on the top) -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><?php echo $this->app_name; ?></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li <?php echo ($this->nav == 0)?'class="active"':''; ?>><a href="index.php">API</a></li>
					<li <?php echo ($this->nav == 1)?'class="active"':''; ?>><a href="index.php">Flows</a></li>
					<li <?php echo ($this->nav == 2)?'class="active"':''; ?>><a href="index.php">Channel Matching</a></li>
					<li <?php echo ($this->nav == 3)?'class="active"':''; ?>><a href="index.php?action=settings">Settings</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!--/Main Navigation -->

<?php $this->container->render(); ?>
	
	<!-- Bootstrap core JavaScript -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"
		type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/holder.js" type="text/javascript"></script>
</body>
</html>
