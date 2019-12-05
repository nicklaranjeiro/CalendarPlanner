<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script type="text/javascript">		
		setTimeout(function() {
			$('#successmessage').fadeOut('slow');
		}, 1000);
	</script>
	
    <title>Login Page</title>
  </head>
  <body>	
	<nav class="navbar navbar-expand-lg navbar-light">
	  <ul class="navbar-nav mr-auto">
		<li class="navbar mr-auto">
		  <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/home/">FamilyUs</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		</li>
	  </ul>
	  <ul class="navbar-nav">
		<li class="navbar-nav">
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
				  <a class="nav-item nav-link" href="<?php echo base_url(); ?>index.php/home/about">About</a>
				</div>
			  </div>
		</li>
		<li class="navbar-nav">
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
				  <a class="nav-item nav-link" href="<?php echo base_url(); ?>index.php/auth/login"><b>Login</b></a>
				</div>
			  </div>
		</li>
	  </ul>
	  
	</nav>
	
	<div class = "col-md-4 offset-md-4 loginContent">
		<h1 style="text-align: center;">Login</h1>
		<p>Fill the details to login!</p>
		<?php if (isset($_SESSION['success'])) { ?>
			<div class="alert alert-success" id="successmessage"> <?php echo $_SESSION['success']; ?></div>
		<?php			
		} ?>
		<?php if (isset($_SESSION['error'])) { ?>
			<div class="alert alert-danger" id="successmessage"> <?php echo $_SESSION['error']; ?></div>
		<?php			
		} ?>
		<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
		<form action="" method="POST">		
			<div class="form-group">
				<label for="username" class="label-default">Username:</label>
				<input class="form-control" name="username" id="username" type="text">
			</div>	
			
			<div class="form-group">
				<label for="password" class="label-default">Password:</label>
				<input class="form-control" name="password" id="password" type="password">
			</div>	
			
			<div>
				<button class="btn btn-primary" name="login">Login</button>
			</div>
		</form>
		<div id="registerfromlogin">New to us? <a href="<?php echo base_url(); ?>index.php/auth/register">Sign Up</a></div>
	</div>
  </body>
</html>