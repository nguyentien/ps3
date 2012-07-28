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
				range_of
		";
		foreach ($dbh->query($sql) as $r) {
			$range = new Range();
			$range->set_id($r['id']);
			$range->set_name($r['name']);
			$result[] = $range;
		}
		
		return $result;
	}
}