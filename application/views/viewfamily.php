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
	
    <title>Family</title>
	
	<script>
		function copyText(){
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val("<?php echo base_url(); ?>index.php/family/joinfamily/<?php echo $_SESSION['familyID']; ?>").select();
			document.execCommand("copy");
			$temp.remove();
		}
	</script>
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
		
		<?php if (($_SESSION['useraccess']) == "admin") { ?>
		<div id="editFamily">
			(<a href="<?php echo base_url(); ?>index.php/family/editfamily/<?php echo $_SESSION['familyID']; ?>">Edit family</a>)
		</div>	
		<?php } ?>
			
			
		<div class = "col-md-6" id="familynameinput">
			<p>Family Name: <input type="text" value="<?php echo $_SESSION['familyname']; ?>" readonly></p>
			<div id="sharableLink">
				<a href="" id="familyLink" onclick="copyText()">Click to copy sharable link</a>
			</div>			
		</div>
		
		<div class = "h-100 col-md-6" id="familymembers">
			<h5 style="text-align: center;">Memebers</h5>
			<ul class="viewfamilymembers">
				<?php if (isset($_SESSION['fetchedUsers'])) { 
					foreach($_SESSION['fetchedUsers'] as $rows){
				?>				
					<li><?php echo $rows['firstname']; ?> <?php echo $rows['lastname']; ?></li>
				<?php }} ?>
			</ul>
		</div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>