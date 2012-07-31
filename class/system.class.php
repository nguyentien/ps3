<?php

class System {
	// Property
	private $var;
	private $val;
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $var
	 */
	public function set_var($var) {
		$this->var = $var;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_var() {
		return $this->var;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $val
	 */
	public function set_val($val) {
		$this->val = $val;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_val() {
		return $this->val;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return multitype:System
	 */
	public static function getValue() {
		$dbh = $GLOBALS['dbh'];
		
		$results = array();
		$sql = "
			SELECT 
				*
			FROM 
				system
		";
		foreach($dbh->query($sql) as $r) {
			$row = new System();
			$row->set_var($r['var']);
			$row->set_val($r['val']);
			$results[] = $row;
		}
		return $results;
	}

	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $value
	 */
	public static function save($value) {
		$dbh = $GLOBALS['dbh'];
		
		$sql = "
			UPDATE 
				system
			SET 
				val=:val
			WHERE 
				var=:var
		";
		$data = $dbh->prepare($sql);
		foreach ($value as $key => $v) {
			$data->execute(array(
				':val' => $v,
				':var' => $key
			));
		}
		if ($data->rowCount()) {
			return true;
		}
		return false;
	}
}