<?php

class Device {
	// Property
	private $id;
	private $uid;
	private $name;
	private $cost;
	private $range;
	private $status;
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
	 * @param unknown_type $status
	 */
	public function set_status($status) {
		$this->status = $status;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_status() {
		return $this->status;
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
				D.*,
				R.name as range_name
			FROM 
				device D
			LEFT JOIN `range` R ON D.range=R.id
		";
		foreach ($dbh->query($sql) as $row) {
			$count = count($rows);
			$rows[$count]['id']			= $row['id'];
			$rows[$count]['uid']		= $row['uid'];
			$rows[$count]['name']		= $row['name'];
			$rows[$count]['cost']		= $row['cost'];
			$rows[$count]['range_id']	= $row['range'];
			$rows[$count]['range_name']	= $row['range_name'];
			$rows[$count]['status']		= $row['status'];
		}
		
		return $rows;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param Device $d
	 */
	public static function save(Device $d) {
		$dbh = $GLOBALS['dbh'];
		
		if ($d->get_id()) {
			// Update
			$data = $dbh->prepare("
				UPDATE 
					device
				SET 
					uid=:uid, name=:name, cost=:cost, `range`=:range, `status`=:status
				WHERE 
					id=:id
			");
			$data->execute(array(
				':uid'		=> $d->get_uid(),
				':name'		=> $d->get_name(),
				':cost'		=> $d->get_cost(),
				':range'	=> $d->get_range(),
				':status'	=> $d->get_status(),
				':id'		=> $d->get_id()
			));
		} else {
			// Insert
			$data = $dbh->prepare("
				INSERT 
					INTO device (uid, name, cost, `range`)
				VALUES
					(:uid, :name, :cost, :range)
			");
			$data->execute(array(
				':uid' => $d->get_uid(),
				':name' => $d->get_name(),
				':cost' => $d->get_cost(),
				':range' => $d->get_range()
			));
		}
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public static function delete($id) {
		$dbh = $GLOBALS['dbh'];
		
		$data = $dbh->prepare("
			DELETE
			FROM 
				device
			WHERE 
				id = :id
		");
		$data->execute(array(
			':id' => $id
		));
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param int $id
	 */
	public static function getById($id) {
		$dbh = $GLOBALS['dbh'];
		
		$sql = "
			SELECT 
				*
			FROM 
				device
			WHERE 
				id=$id
		";
		foreach ($dbh->query($sql) as $r) {
			$d = new Device();
			$d->set_id($id);
			$d->set_name($r['name']);
			$d->set_uid($r['uid']);
			$d->set_cost($r['cost']);
			$d->set_range($r['range']);
			$d->set_status($r['status']);
		}
		return $d;
	}
}