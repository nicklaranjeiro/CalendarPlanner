<?php

class Family extends CI_Controller {
	
	public function viewfamily($familyID)
	{
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to view this page");
			redirect("auth/login");
		}
		
		if($_SESSION['familyname'] == "No Assigned Family"){
			redirect("user/calendar");
		}
		
		if($_SESSION['familyID'] !== $familyID){
			redirect("user/calendar");
		}

		$this->load->model("Family_model");
		$fetchedUsers = $this->Family_model->familymembers($_SESSION['familyID']);
		$_SESSION['fetchedUsers'] = $fetchedUsers;
		$this->load->view('viewfamily');		
	}
	
	public function joinfamily($familyID){
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to join a family!");
			redirect("auth/login");			
		}
		
		$this->load->model("Family_model");
		$fetchedUsers = $this->Family_model->familyjoin($familyID, $_SESSION['userID']);
		
		$_SESSION['familyname'] = $fetchedUsers[0]['familyName'];	
		$_SESSION['familyID'] = $fetchedUsers[0]['familyID'];	
		$this->session->set_flashdata("success", "Successfully joined a family!");
		
		redirect("user/calendar");
	}
	
	public function editfamily($familyID){
		if($_SESSION['user_logged'] == FALSE){
			$this->session->set_flashdata("error", "You need to login to join a family!");
			redirect("auth/login");			
		}
		
		if($_SESSION['useraccess'] == "member" || $_SESSION['familyID'] !== $familyID){
			$this->session->set_flashdata("error", "You cannot view this page!");
			redirect("user/calendar");
		}
			
		$this->load->view('editfamily');
		
	}
	
	public function removeFamily($userID, $familyID){
		$this->load->model("Family_model");
		$this->Family_model->familyremove($userID);
		
		$fetchedUsers = $this->Family_model->familymembers($familyID);
		$_SESSION['fetchedUsers'] = $fetchedUsers;
		
		$this->session->set_flashdata("success", "Successfully deleted from family");		
		redirect("family/editfamily/" . $familyID);
	}
}
