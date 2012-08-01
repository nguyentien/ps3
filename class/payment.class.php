<?php

class Payment {
	// Property
	private $id;
	private $device;
	private $start;
	private $stop;
	private $surcharge;
	private $discount;
	private $comment;
	private $status;
	private $date;
	
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
	 */
	public function get_id() {
		return $this->id;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $device
	 */
	public function set_device($device) {
		$this->device = $device;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_device() {
		return $this->device;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $start
	 */
	public function set_start($start) {
		$this->start = $start;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_start() {
		return $this->start;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $stop
	 */
	public function set_stop($stop) {
		$this->stop = $stop;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_stop() {
		return $this->stop;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $surcharge
	 */
	public function set_surcharge($surcharge) {
		$this->surcharge = $surcharge;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_surcharge() {
		return $this->surcharge;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $discount
	 */
	public function set_discount($discount) {
		$this->discount = $discount;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_discount() {
		return $this->discount;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $comment
	 */
	public function set_comment($comment) {
		$this->comment = $comment;
	}
	
	public function get_comment() {
		return $this->comment;
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
	 * @param unknown_type $status
	 */
	public function get_status() {
		return $this->status;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $date
	 */
	public function set_date($date) {
		$this->date = $date;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_date() {
		return $this->date;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public static function getAll() {
		$dbh = $GLOBALS['dbh'];
		
		$result = array();
		$sql = "
			SELECT
				* 
			FROM 
				`range`
		";
		foreach ($dbh->query($sql) as $r) {
			$range = new Range();
			$range->set_id($r['id']);
			$range->set_name($r['name']);
			$result[] = $range;
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $r
	 */
	public static function save(Range $r) {
		$dbh = $GLOBALS['dbh'];
		
		if ($r->get_id()) {
			// Update
			$data = $dbh->prepare("
				UPDATE 
					`range`
				SET 
					name=:name
				WHERE 
					id=:id
			");
			$data->execute(array(
				':name'  => $r->get_name(),
				':id'    => $r->get_id()
			));
			return true;
		} else {
			// Insert
			$data = $dbh->prepare("
				INSERT 
					INTO `range` (name)
				VALUES
					(:name)
			");
			$data->execute(array(
				':name' => $r->get_name(),
			));
			if ($data->rowCount()) {
				return true;
			}
		}
		return false;
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
				`range`
			WHERE 
				id = :id
		");
		$data->execute(array(
			':id' => $id
		));
		if ($data->rowCount()) {
			return true;
		}
		return false;
	}
}