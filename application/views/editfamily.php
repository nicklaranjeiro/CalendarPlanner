<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	
	<script type="text/javascript">		
		setTimeout(function() {
			$('#successmessage').fadeOut('slow');
		}, 1000);
	</script>
	
    <title>Edit Family</title>	
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
				  <a class="nav-item nav-link" href="<?php echo base_url(); ?>index.php/user/profile">Profile</a>
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
	
	<div class = "col-md-8 offset-md-2" style="height: 60vh;">
		<h1 style="text-align: center;"><?php echo $_SESSION['familyname']; ?> Family</h1>			
		
		<div class = "h-100 col-md-6 offset-md-3" id="familymembersedit">
			<?php if (isset($_SESSION['success'])) { ?>
			<div class="alert alert-success" id="successmessage"> <?php echo $_SESSION['success']; ?></div>
			<?php			
			} ?>
			
			<h5 style="text-align: center;">Memebers</h5>
			<ul class="viewfamilymembers">
				<?php if (isset($_SESSION['fetchedUsers'])) { 
					foreach($_SESSION['fetchedUsers'] as $rows){
				?>				
					<li><?php echo $rows['firstname']; ?> <?php echo $rows['lastname']; ?>
						<?php if ($_SESSION['firstname'] !== $rows['firstname'] && $_SESSION['lastname'] !== $rows['lastname']){ ?>
							<div class="removeUser"><a href="<?php echo base_url(); ?>index.php/family/removefamily/<?php echo $rows['userID']; ?>/<?php echo $rows['familyID']; ?>">Remove</a></div>
						<?php }else{ ?>
							<div class="removeUser">(You)</div>
						<?php }?>
					</li>
				<?php }} ?>
			</ul>
		</div>
	</div>
  </body>
</html>