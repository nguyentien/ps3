<?php

class Range {
	// Property
	private $id;
	private $name;
	
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
	 * @param Range $r
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
				`range`
			WHERE 
				id = :id
		");
		$data->execute(array(
			':id' => $id
		));
	}
}