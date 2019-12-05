<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

	<script type="text/javascript">
		$(document).ready(function(){
			var calendar = $('#calendar').fullCalendar({
				height: 750,
				editable: true,
				events: <?php echo json_encode($_SESSION['calendarEvents']) ?>,
				selectHelper: true,
				selectable: true,
				select: function(start, end, allDay ){
					document.getElementById('modalForm').click();
					var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
					document.getElementById('startDate').value = start;
					var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
					document.getElementById('endDate').value = end;
				},
				eventClick: function(event){
					document.getElementById('modaldForm').click();
					document.getElementById('eventTitle').value = event.title;
					document.getElementById('eventID').value = event.id;
					document.getElementById('assignedTo').value = event.assignedName;
					document.getElementById('eventNote').value = event.note;
					console.log(event);
				},
				eventDrop:function(event){
					document.getElementById('modalmForm').click();
					var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
					document.getElementById('startmDate').value = start;
					var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
					document.getElementById('endmDate').value = end;
					document.getElementById('eventmID').value = event.id;
					document.getElementById('updatefamilyevent').click();				
				}
			});
		});
		
		setTimeout(function() {
			$('#successmessage').fadeOut('slow');
		}, 1000);
		
		function editInfo(){
			document.getElementById("eventeID").value = document.getElementById("eventID").value;
			document.getElementById("addeevent").value = document.getElementById("eventTitle").value;
			document.getElementById("assignedeName").value = document.getElementById("assignedTo").value;
			document.getElementById("addenote").value = document.getElementById("eventNote").value;
		}
		
		function noteInfo(){
			document.getElementById("eventdNote").value = document.getElementById("eventNote").value;
		}
	</script>	
    <title>Calendar</title>
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
	
	<div class = "col-md-10 offset-md-1">
		<h1 style="text-align: center;">Calendar</h1>
		<?php if ($_SESSION['familyname'] == "No Assigned Family") { ?>
			<?php if (isset($_SESSION['success'])) { ?>
			<div class="alert alert-success" id="successmessage"> <?php echo $_SESSION['success']; ?></div>
			<?php			
			} ?>
			<p> If you are not seeing your Calendar you have not yet joined or created a family! </p>
			<p> You need a link from your family leader so you can sync and plan events together </p>
			
		<?php			
		}else{?>
			<div id="viewFamily">
				(<a href="<?php echo base_url(); ?>index.php/family/viewfamily/<?php echo $_SESSION['familyID']; ?>">View your family</a>)
			</div>	
			<?php if (isset($_SESSION['success'])) { ?>
			<div class="alert alert-success" id="successmessage"> <?php echo $_SESSION['success']; ?></div>
			<?php			
			} ?>
			<div class="container">
				<div id="calendar"></div>
			</div>	
		<?php } ?>	
		

		<?php if (($_SESSION['useraccess']) == "admin" && ($_SESSION['familyname']) == "No Assigned Family") { ?>
			<a href="<?php echo base_url(); ?>index.php/user/createfamily">Create family</a>
		<?php			
		} ?>	
	</div>
	<div id="eventmodal" class="modal modaln">
		<form action="" method="POST" name ="newEvent" id ="newEvent">
			<div class="form-group">
				<p>Event Name: <input type="text" name="addevent" id="addevent" placeholder ="Add event title" required></p>
				<p>Assign To: <select name = "assignedName" id = "assignedName">
					<?php if (isset($_SESSION['fetchedUsers'])) { 
						foreach($_SESSION['fetchedUsers'] as $rows){
					?>				
						<option value='<?php echo $rows['firstname']; ?>'><?php echo $rows['firstname']; ?>
						</option>
					<?php }} ?>
				</select>
				</p>
				<p>Add Note: <input type="text" name="addnote" id="addnote"></p>
				<p hidden>Start: <input type="datetime" name ="startDate" id = "startDate"></p>
				<p hidden>End: <input type="datetime" name ="endDate" id = "endDate"></p>
			</div>
			<div class="eventbtn">
				<button class="btn btn-primary" name="familyevent">Add Event</button>
			</div>				
		</form>
	</div>
	 <a href="#eventmodal" rel="modal:open" id = "modalForm" hidden></a>
	 
	 <div id="detaileventmodal" class="modal">
		<form action="" method="POST" name ="newEvent" id ="newEvent">
			<div class="form-group">
				<p hidden>ID: <input type="text" name="eventID" id="eventID"></p>
				<p>Event Title: <input type="text" name="eventTitle" id="eventTitle" readonly></p>
				<p>Assigned To: <input type="text" name="assignedTo" id="assignedTo" readonly></p>
				<p hidden>Add Note: <input type="text" name="eventNote" id="eventNote"></p>
			</div>			
			<div class="deleteeventbtn" style="display:inline-block; margin-right: 10%;">
				<button class="btn btn-danger" name="deletefamilyevent">Delete Event</button>
			</div>			
			<div class="editeventbtn" style="display:inline-block;">
				<a href="#noteeventmodal" rel="modal:open" id = "modalnForm" id="noteEvent" onclick="noteInfo()">View Note</a><span> | </span>
				<a href="#editeventmovemodal" rel="modal:open" id = "modaleForm" id="editevent" onclick="editInfo()">Edit Event</a>
			</div>
			<div class="completeeventbtn" style="display:inline-block; float: right;">
				<button class="btn btn-success" name="completefamilyevent">Finished</button>
			</div>
		</form>
	</div>
	 <a href="#detaileventmodal" rel="modal:open" id = "modaldForm" hidden></a>
	 
	 <div id="eventmovemodal" class="modal" hidden>
		<form action="" method="POST" name ="newEvent" id ="newEvent">
			<div class="form-group">
				<p hidden>ID: <input type="text" name="eventmID" id="eventmID"></p>
				<p hidden>Start: <input type="datetime" name ="startmDate" id ="startmDate"></p>
				<p hidden>End: <input type="datetime" name ="endmDate" id ="endmDate"></p>
			</div>
			<div class="eventbtn" hidden>
				<button class="btn btn-primary" name="updatefamilyevent" id = "updatefamilyevent">Update Event</button>
			</div>	
			<div>
				<p>Updating...</p>
			</div>
		</form>
	</div>
	<a href="#eventmovemodal" rel="modal:open" id = "modalmForm" hidden></a>
	 
	 <div id="editeventmovemodal" class="modal modaln">
		<form action="" method="POST" name ="newEvent" id ="newEvent">
			<div class="form-group">
				<p hidden>ID: <input type="text" name="eventeID" id="eventeID"></p>
				<p>Event Name: <input type="text" name="addeevent" id="addeevent" required></p>
				<p>Assign To: <select name = "assignedeName" id = "assignedeName">
					<?php if (isset($_SESSION['fetchedUsers'])) { 
						foreach($_SESSION['fetchedUsers'] as $rows){
					?>				
						<option value='<?php echo $rows['firstname']; ?>'><?php echo $rows['firstname']; ?>
						</option>
					<?php }} ?>
				</select>
				<p>Event Note: <input type="text" name="addenote" id="addenote"></p>
			</div>
			<div class="eventbtn">
				<button class="btn btn-primary" name="updatenewfamilyevent" id = "updatenewfamilyevent">Update Event</button>
			</div>	
		</form>
	</div>
	
	<div id="noteeventmodal" class="modal">
		<p>Note: <textarea type="text" name="eventdNote" id="eventdNote" readonly></p>
	</div>
  </body>
</html>