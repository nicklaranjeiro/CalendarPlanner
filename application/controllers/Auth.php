<?php

class Auth extends CI_Controller
{
	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		
		if($this->form_validation->run() == TRUE){
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			
			$this->load->model("Auth_model");
			$fetchedUser = $this->Auth_model->login($username, $password);
	
			if(!empty($fetchedUser)){
				$this->session->set_flashdata("success", "You are logged in!");
				foreach ($fetchedUser as $row)
				{
						$_SESSION['firstname'] = $row['firstname'];
						$_SESSION['lastname'] = $row['lastname'];
						$_SESSION['email'] =  $row['email'];
						$_SESSION['familyname'] =  $row['familyName'];
						$_SESSION['useraccess'] =  $row['useraccess'];
						$_SESSION['userID'] =  $row['userID'];
						$_SESSION['loginID'] =  $row['loginID'];
						$_SESSION['familyID'] =  $row['familyID'];
						$_SESSION['password'] = $_POST['password'];
						
				}
				//Sets the session variables
				$_SESSION['user_logged'] = TRUE;
				$_SESSION['username'] = $username;

				redirect("user/calendar", "refresh");
			}else{
				$this->session->set_flashdata("error", "User account does not exist");
				redirect("auth/login", "refresh");
			}
		}
		$this->load->view('login');
	}

	public function logout()
	{
		unset($_SESSION);
		session_destroy();
		redirect("home", "refresh");
	}

	public function register()
	{
		if(isset($_POST['register'])){
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[loginInfo.username]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'required|min_length[6]|matches[password]');

			if($this->form_validation->run() == TRUE){
				echo 'form validated';
				
				$this->load->model("Auth_model");				
				$newUserID = $this->Auth_model->userID();
				
				foreach ($newUserID as $row)
				{
					$userID = $row['MAX(loginID) + 1'];	
					
					$userData = array(
						'firstname'=>$_POST['firstname'],
						'lastname'=>$_POST['lastname'],
						'email'=>$_POST['email'],	
						'userID'=> $userID,
						'familyID'=> 1
					);

					$loginInfo = array(
						'username'=>$_POST['username'],
						'password'=>md5($_POST['password']),
						'useraccess'=>$_POST['useraccess'],
						'loginID'=> $userID
					);
					
					$this->db->insert('users', $userData);
					$this->db->insert('loginInfo', $loginInfo);					
				}				
				
				$this->session->set_flashdata("success", "Account registration successful!");
				redirect("auth/login", "refresh");
				
			}
		}
		$this->load->view('register');
	}
}