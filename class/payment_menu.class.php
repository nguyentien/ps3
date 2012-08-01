<?php

class Payment_Menu {
	// Property
	private $id;
	private $payment;
	private $menu;
	private $number;
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
	 * @param unknown_type $payment
	 */
	public function set_payment($payment) {
		$this->payment = $payment;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_payment() {
		return $this->payment;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $menu
	 */
	public function set_menu($menu) {
		$this->menu = $menu;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_menu() {
		return $this->menu;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $number
	 */
	public function set_number($number) {
		$this->number = $number;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_number() {
		return $this->number;
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
	 * @param unknown_type $payment_id
	 * @return Ambigous <multitype:, unknown>
	 */
	public static function getByPayment($payment_id) {
		$dbh = $GLOBALS['dbh'];
		
		$result = array();
		$sql = "
			SELECT 
				PM.id, P.id as payment, M.id as menu, M.name, M.unit, PM.number, PM.number*M.cost AS total
			FROM 
				payment_menu PM
				INNER JOIN payment P ON PM.payment=P.id 
				INNER JOIN menu M ON PM.menu=M.id
			WHERE 
				P.id=$payment_id
		";
		foreach ($dbh->query($sql) as $r) {
			$count = count($result);
			$result[$count]['id'] = $r['id'];
			$result[$count]['payment'] = $r['payment'];
			$result[$count]['menu'] = $r['menu'];
			$result[$count]['name'] = $r['name'];
			$result[$count]['unit'] = $r['unit'];
			$result[$count]['number'] = $r['number'];
			$result[$count]['total'] = $r['total'];
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param Payment_Extra $p
	 * @return unknown
	 */
	public static function save(Payment_Menu $p) {
		$dbh = $GLOBALS['dbh'];
		
		// Insert
		$data = $dbh->prepare("
			INSERT 
				INTO payment_menu (payment, menu, number, date)
			VALUES
				(:payment, :menu, :number, :date)
		");
		$data->execute(array(
			':payment'	=> $p->get_payment(),
			':menu'		=> $p->get_menu(),
			':number'	=> $p->get_number(),
			':date'		=> $p->get_date()
		));
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
				payment_menu
			WHERE 
				id=$id
		");
		$data->execute(array(
			':id' => $id
		));
	}
}