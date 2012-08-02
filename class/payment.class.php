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
	public static function getById($id) {
		$dbh = $GLOBALS['dbh'];
		
		$sql = "
			SELECT
				* 
			FROM 
				`payment`
			WHERE
				id=$id	
		";
		foreach ($dbh->query($sql) as $r) {
			$payment = new Payment();
			$payment->set_id($id);
			$payment->set_device($r['device']);
			$payment->set_start($r['start']);
			$payment->set_stop($r['stop']);
			$payment->set_surcharge($r['surcharge']);
			$payment->set_discount($r['discount']);
			$payment->set_comment($r['comment']);
			$payment->set_status($r['status']);
			$payment->set_date($r['date']);
		}
		
		return $payment;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $r
	 */
	public static function save(Payment $p) {
		$dbh = $GLOBALS['dbh'];
		
		if ($p->get_id()) {
			// Update
			$data = $dbh->prepare("
				UPDATE 
					`payment`
				SET 
					device=:device,
					start=:start,
					stop=:stop,
					surcharge=:surcharge,
					discount=:discount,
					comment=:comment,
					status=:status,
					date=:date,
				WHERE 
					id=:id
			");
			$data->execute(array(
				':device'		=> $p->get_device(),
				':start'		=> $p->get_start(),
				':stop'			=> $p->get_stop(),
				':surcharge'	=> $p->get_surcharge(),
				':discount'		=> $p->get_discount(),
				':comment'		=> $p->get_comment(),
				':status'		=> $p->get_status(),
				':date'			=> $p->get_date(),
				':id'			=> $p->get_id()
			));
		} else {
			// Insert
			$data = $dbh->prepare("
				INSERT 
					INTO `payment` (device, start, stop, surcharge, discount, comment, status, date)
				VALUES
					(:device, :start, :stop, :surcharge, :discount, :comment, :status, :date)
			");
			$data->execute(array(
				':device'		=> $p->get_device(),
				':start'		=> $p->get_start(),
				':stop'			=> $p->get_stop(),
				':surcharge'	=> $p->get_surcharge(),
				':discount'		=> $p->get_discount(),
				':comment'		=> $p->get_comment(),
				':status'		=> $p->get_status(),
				':date'			=> $p->get_date()
			));
			if ($data->rowCount()) {
				return $dbh->lastInsertId();
			}
		}
		return 0;
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