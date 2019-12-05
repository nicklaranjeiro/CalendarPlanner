<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to view this page");
			redirect("auth/login");
		}
	}
	
	public function profile()
	{
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to view this page");
			redirect("auth/login");
		}
		
		$this->load->model("Auth_model");			
		
		if(isset($_POST['changefirstname'])){
			$this->Auth_model->updatefield("firstname", $_POST['changefirstname'], $_SESSION['userID']);
			$_SESSION['firstname'] = $_POST['changefirstname'];
		}elseif(isset($_POST['changelastname'])){
			$this->Auth_model->updatefield("lastname", $_POST['changelastname'], $_SESSION['userID']);
			$_SESSION['lastname'] = $_POST['changelastname'];
		}elseif(isset($_POST['changeemail'])){
			$this->Auth_model->updatefield("email", $_POST['changeemail'], $_SESSION['userID']);
			$_SESSION['email'] = $_POST['changeemail'];
		}
		
		$this->load->view('profile');
	}
	
	public function calendar()
	{
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to view this page");
			redirect("auth/login");
		}
		$this->load->model("Auth_model");
		$_SESSION['calendarEvents'] = $this->Auth_model->familyEvents($_SESSION['familyID']);
		
		$this->load->model("Family_model");
		$_SESSION['fetchedUsers'] = $this->Family_model->familymembers($_SESSION['familyID']);
		
		if(isset($_POST['addevent'])){
			$eventInfo = array(
				'familyID'=> $_SESSION['familyID'],
				'title'=>$_POST['addevent'],
				'start'=>$_POST['startDate'],
				'note'=> $_POST['addnote'],
				'end'=>$_POST['endDate'],
				'assignedName'=>$_POST['assignedName']
			);
			$this->db->insert('familyEvents', $eventInfo);
			redirect("user/calendar");
		}
		
		if(isset($_POST['deletefamilyevent'])){
			$this->load->model("Family_model");
			$this->Family_model->deleteEvent($_POST['eventID']);
			redirect("user/calendar");
		}
		
		if(isset($_POST['completefamilyevent'])){
			$this->load->model("Family_model");
			$this->Family_model->finishEvent($_POST['eventID']);
			redirect("user/calendar");
		}
		
		if(isset($_POST['updatefamilyevent'])){
			$this->load->model("Family_model");
			$this->Family_model->moveEvent($_POST['eventmID'], $_POST['startmDate'], $_POST['endmDate']);
			redirect("user/calendar");
		}
		
		if(isset($_POST['updatenewfamilyevent'])){
			$this->load->model("Family_model");
			$this->Family_model->editEvent($_POST['eventeID'], $_POST['addeevent'], $_POST['assignedeName'], $_POST['addenote']);
			redirect("user/calendar");
		}
		
		$this->load->view('calendar');
	}
	
	public function createfamily()
	{
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to view this page");
			redirect("auth/login");
		}
		
		if(isset($_POST['createfamily'])){
			$this->form_validation->set_rules('familyname', 'Family Name', 'required');

			if($this->form_validation->run() == TRUE){
				echo 'form validated';

				$familyInfo = array(
					'familyname'=>$_POST['familyname']
				);
				
				$this->db->insert('families', $familyInfo);
				$this->session->set_flashdata("success", "Family creation successful!");

				$this->load->model("Auth_model");				
				$newFamilyID = $this->Auth_model->newFamilyID($_POST['familyname']);
				
				foreach ($newFamilyID as $row)
				{
					$this->Auth_model->updateFamilyID($row['familyID'], $_SESSION['userID'] );
					$_SESSION['familyname'] = $_POST['familyname'];
					$_SESSION['familyID'] =  $row['familyID'];
				}
			
				redirect("user/calendar", "refresh");
				
			}
		}
		
		$this->load->view('create');
	}
	
	public function resetpassword(){
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to view this page");
			redirect("auth/login");
		}
	  
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[6]|matches[' . $_SESSION['password'] . ']');
		$this->form_validation->set_message('matches', 'Password do not match or you cannot be using your old password');
		$this->form_validation->set_rules('confirmnewpassword', 'Confirm New Password', 'required|min_length[6]|matches[newpassword]');		
		
		if($this->form_validation->run() == TRUE){
			$newpassword = md5($_POST['newpassword']);
			
			$this->load->model("Auth_model");
			$this->Auth_model->resetpassword($newpassword, $_SESSION['loginID']);
			$this->session->set_flashdata("success", "Password updated");
			redirect("user/profile");
		}	
		
		$this->load->view("resetpassword");
	}
	
	public function send() {
		$this->load->library('email');
        $config['protocol'] = 'mail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);
		
		$this->email->from('nicholaslarajneiro@hotmail.com', 'Nicholas');
		$this->email->to('nicholaslaranjeiro@hotmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();
    }

}