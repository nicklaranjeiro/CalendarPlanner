<?php

class Family_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}	

	public function familymembers($familyID)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('familyID' => $familyID));
		$query = $this->db->get();
		$users = $query->result_array();
		return $users;
	}
	
	public function familyjoin($familyID, $userID)
	{
		$this->db->set('familyID', $familyID, FALSE);
		$this->db->where('userID', $userID );
		$this->db->update('users');
		
		$this->db->select('*');
		$this->db->from('families');
		$this->db->where(array('familyID' => $familyID));
		$query = $this->db->get();
		$familyID = $query->result_array();
		return $familyID;
	}
	
	public function familyremove($userID){
		$this->db->set('familyID', 1, FALSE);
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
	
	public function deleteEvent($eventID){
		$this->db->where('id', $eventID);
		$this->db->delete('familyEvents');
	}
	
	public function finishEvent($eventID){
		$this->db->set('color', '#32CD32', TRUE);
		$this->db->where('id', $eventID );
		$this->db->update('familyEvents');
	}
	
	public function moveEvent($eventID, $startDate, $endDate){
		$this->db->set('start', $startDate, TRUE);
		$this->db->where('id', $eventID );
		$this->db->update('familyEvents');
		
		$this->db->set('end', $endDate, TRUE);
		$this->db->where('id', $eventID );
		$this->db->update('familyEvents');
	}
	
	public function editEvent($eventID, $eventTitle, $assignedName, $eventNote){
		$this->db->set('title', $eventTitle, TRUE);
		$this->db->where('id', $eventID );
		$this->db->update('familyEvents');
		
		$this->db->set('assignedName', $assignedName, TRUE);
		$this->db->where('id', $eventID );
		$this->db->update('familyEvents');
		
		$this->db->set('note', $eventNote, TRUE);
		$this->db->where('id', $eventID );
		$this->db->update('familyEvents');
	}
}