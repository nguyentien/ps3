<?php

class Device {
	// Property
	private $id;
	private $uid;
	private $name;
	private $cost;
	private $range;
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function set_id($id) {
		$this->id = $id;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $uid
	 */
	public function set_uid($uid) {
		$this->uid = $uid;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $name
	 */
	public function set_name($name) {
		$this->name = $name;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $cost
	 */
	public function set_cost($cost) {
		$this->cost = $cost;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $range
	 */
	public function set_range($range) {
		$this->range = $range;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_id() {
		return $this->id;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_uid() {
		return $this->uid;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_name() {
		return $this->name;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_cost() {
		return $this->cost;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_range() {
		return $this->range;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return multitype:Device
	 */
	public static function getAll() {
		// Get connect db
		$dbh = $GLOBALS['dbh'];
		
		$rows = array();
		$sql = "
			SELECT 
				* 
			FROM 
				device
		";
		foreach ($dbh->query($sql) as $row) {
			$device = new Device();
			$device->set_id($row['id']);
			$device->set_uid($row['uid']);
			$device->set_name($row['name']);
			$device->set_cost($row['cost']);
			$device->set_range($row['range']);
			$rows[] = $device;
		}
		
		return $rows;
	}
	/**
	 * 
	 * Enter description here ...
	 */
	public static function insert() {
		$data = $dbh->prepare("INSERT INTO device VALUES(:id, :uid, :name, :cost, :range)");
		$data->execute(array(
			':id'   => $this->id,
			':uid' => $this->uid,
			':name' => $this->name,
			':cost' => $this->cost,
			':range' => $this->range
		));
	}
}