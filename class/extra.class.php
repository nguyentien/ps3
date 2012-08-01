<?php

class Extra {
	// Property
	private $id;
	private $name;
	private $unit;
	private $cost;
	
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
	 * @param unknown_type $name
	 */
	public function set_name($name) {
		$this->name = $name;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_name() {
		return $this->name;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $unit
	 */
	public function set_unit($unit) {
		$this->unit = $unit;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_unit() {
		return $this->unit;
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
	 * @param unknown_type $cost
	 */
	public function get_cost() {
		return $this->cost;
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