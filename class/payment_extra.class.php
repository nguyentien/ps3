<?php

class Payment_Extra {
	// Property
	private $id;
	private $payment;
	private $extra;
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
	 * @param unknown_type $id
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
	 * @param unknown_type $device
	 */
	public function set_extra($extra) {
		$this->extra = $extra;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function get_extra() {
		return $this->extra;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $start
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
	 */
	public static function getById($id) {
		$dbh = $GLOBALS['dbh'];
		
		$result = array();
		$sql = "
			SELECT 
				PE.id, P.id as payment, E.id as extra, E.name, E.unit, PE.number, PE.number*E.cost AS tt
			FROM 
				payment_extra PE 
				INNER JOIN payment P ON PE.payment=P.id 
				INNER JOIN extra E ON PE.extra=E.id
			WHERE 
				P.id=$id
		";
		foreach ($dbh->query($sql) as $r) {
			$count = count($result);
			$result[$count]['id'] = $r['id'];
			$result[$count]['payment'] = $r['payment'];
			$result[$count]['extra'] = $r['extra'];
			$result[$count]['name'] = $r['name'];
			$result[$count]['unit'] = $r['unit'];
			$result[$count]['number'] = $r['number'];
			$result[$count]['tt'] = $r['tt'];
		}
		
		return $result;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $r
	 */
	public static function save(Payment_Extra $p) {
		$dbh = $GLOBALS['dbh'];
		
		// Insert
		$data = $dbh->prepare("
			INSERT 
				INTO `payment_extra` (payment, extra, number, date)
			VALUES
				(:payment, :extra, :number, :date)
		");
		$data->execute(array(
			':payment'	=> $p->get_payment(),
			':extra'	=> $p->get_extra(),
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
				`payment_extra`
			WHERE 
				id=$id
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