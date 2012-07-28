<?php

class Menu {
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
				extra
		";
		foreach ($dbh->query($sql) as $r) {
			$menu = new Menu();
			$menu->set_id($r['id']);
			$menu->set_name($r['name']);
			$menu->set_unit($r['unit']);
			$menu->set_cost($r['cost']);
			
			$result[] = $menu;
		}
		
		return $result;
	}
}