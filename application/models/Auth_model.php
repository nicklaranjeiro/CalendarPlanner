<?php

class Auth_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}	

	public function login($username, $password)
	{
		//check if the user is in the database
		$this->db->select('*');
		$this->db->from('loginInfo');
		$this->db->join('users', 'loginInfo.loginID = users.userID');
		$this->db->join('families', 'users.familyID = families.familyID');
		$this->db->where(array('loginInfo.username' => $username, 'loginInfo.password' => $password));
		$query = $this->db->get();
		$user = $query->result_array();
		return $user;
	}
	
	public function userID()
	{
		$this->db->select('MAX(loginID) + 1');
		$this->db->from('loginInfo');
		$query = $this->db->get();
		$userID = $query->result_array();
		return $userID;
	}
	
	public function updateFamilyID($familyID, $userID)
	{
		$this->db->set('familyID', $familyID, FALSE);
		$this->db->where('userID', $userID );
		$this->db->update('users');
	}
	
	public function newFamilyID($familyName)
	{
		$this->db->select('*');
		$this->db->from('families');
		$this->db->where(array('familyName' => $familyName));
		$query = $this->db->get();
		$familyID = $query->result_array();
		return $familyID;
	}
	
	public function resetpassword($newpassword, $loginID){
		$this->db->set('password', $newpassword, TRUE);
		$this->db->where('loginID', $loginID );
		$this->db->update('loginInfo');
	}	
	
	public function updatefield($field, $newvalue, $userID){
		$this->db->set($field, $newvalue, TRUE);
		$this->db->where('userID', $userID );
		$this->db->update('users');
	}	
	
	public function familyEvents($familyID){
		$this->db->select('*');
		$this->db->from('familyEvents');
		$this->db->where('familyID', $familyID);
		$query = $this->db->get();
		$familyEvents = $query->result_array();
		return $familyEvents;
	}	
}