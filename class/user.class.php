<?php

class User {
	// Property
	private $id;
	private $user;
	private $pass;
	
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
	 * @return Ambigous <unknown_type, unknown>
	 */
	public function get_id() {
		return $this->id;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $user
	 */
	public function set_user($user) {
		$this->user = $user;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_user() {
		return $this->user;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $pass
	 */
	public function set_pass($pass) {
		$this->id = $pass;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_pass() {
		return $this->pass;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $user
	 * @param unknown_type $pass
	 * @return boolean
	 */
	public static function login($user, $pass) {
		if ($user == 'admin' && $pass == 'admin') {
			return true;
		} else {
			return false;
		}
	}
	
}