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
	
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	
	<script type="text/javascript">		
		setTimeout(function() {
			$('#successmessage').fadeOut('slow');
		}, 1000);
	</script>
	
    <title>Profile</title>
  </head>
  <body>	
	<nav class="navbar navbar-expand-lg navbar-light">
	  <ul class="navbar-nav mr-auto">
		<li class="navbar mr-auto">
		  <a class="navbar-brand" href="<?php echo base_url(); ?>index.php/user/calendar">FamilyUs</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		</li>
	  </ul>
	  <ul class="navbar-nav">
		<li class="navbar-nav">
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
				  <a class="nav-item nav-link" href="<?php echo base_url(); ?>index.php/user/profile"><b>Profile</b></a>
				</div>
			  </div>
		</li>
		<li class="navbar-nav">
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
				  <a class="nav-item nav-link" href="<?php echo base_url(); ?>index.php/auth/logout">Logout</a>
				</div>
			  </div>
		</li>
	  </ul>
	  
	</nav>
	
	<div class = "col-md-8 offset-md-2">
		<h1 style="text-align: center;">Profile</h1>
		<?php if (isset($_SESSION['success'])) { ?>
			<div class="alert alert-success" id="successmessage"> <?php echo $_SESSION['success']; ?></div>
		<?php			
		} ?>
		
		<img id="profilepicture" class="col-md-6" src="<?php echo base_url(); ?>assets/img/profiledefault.png">
		<ul class="list-group list-group-flush">
		  <li class="list-group-item"><b>First Name:</b> <?php echo $_SESSION['firstname'] ?> (<a href="#firstnamemodal" rel="modal:open">Edit</a>) </li>
		  <li class="list-group-item"><b>Last Name:</b> <?php echo $_SESSION['lastname'] ?> (<a href="#lastnamemodal" rel="modal:open">Edit</a>)</li>
		  <li class="list-group-item"><b>E-mail address:</b> <?php echo $_SESSION['email'] ?> (<a href="#emailmodal" rel="modal:open">Edit</a>)</li>
		  <li class="list-group-item"><b>Families:</b> <?php echo $_SESSION['familyname'] ?> </li>
		</ul>	
		<div class="resetpassword"><a href="<?php echo base_url(); ?>index.php/user/resetpassword">Reset Password</a></div>
		
		<div id="firstnamemodal" class="modal">
			<form action="" method="POST">
				<div class="form-group">
					<p>First Name: <input type="text" name="changefirstname" id="changefirstname" value="<?php echo $_SESSION['firstname'] ?>"></p>		  
				</div>
				<div class="updatebtn">
					<button class="btn btn-primary" name="updatename">Update</button>
				</div>				
			</form>
		</div>
		
		<div id="lastnamemodal" class="modal">
			<form action="" method="POST">
				<div class="form-group">
					<p>Last Name: <input type="text" name="changelastname" id="changelastname" value="<?php echo $_SESSION['lastname'] ?>"></p>		  
				</div>
				<div class="updatebtn">
					<button class="btn btn-primary" name="updatename">Update</button>
				</div>				
			</form>
		</div>
		
		<div id="emailmodal" class="modal">
			<form action="" method="POST">
				<div class="form-group">
					<p>E-mail: <input type="text" name="changeemail" id="changeemail" value="<?php echo $_SESSION['email'] ?>"></p>		  
				</div>
				<div class="updatebtn">
					<button class="btn btn-primary" name="updatename">Update</button>
				</div>				
			</form>
		</div>
	</div>	
  </body>
</html>