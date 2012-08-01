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
	 * @param unknown_type $payment_id
	 * @return Payment
	 */
	public static function getById($payment_id) {
		$dbh = $GLOBALS['dbh'];
		
		$sql = "
			SELECT
				* 
			FROM 
				payment
			WHERE
				id=$payment_id
		";
		foreach ($dbh->query($sql) as $r) {
			$payment = new Payment();
			$payment->set_id($payment_id);
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
	 * @param unknown_type $device
	 * @return Payment
	 */
	public static function getByDevice($device) {
		$dbh = $GLOBALS['dbh'];
	
		$sql = "
				SELECT
					* 
				FROM 
					payment
				WHERE
					device=$device AND status=1
			";
		foreach ($dbh->query($sql) as $r) {
			$payment = new Payment();
			$payment->set_id($r['id']);
			$payment->set_device($device);
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
	 * @param Payment $p
	 * @return number
	 */
	public static function save(Payment $p) {
		$dbh = $GLOBALS['dbh'];
		
		if ($p->get_id()) {
			// Update
			$data = $dbh->prepare("
				UPDATE 
					payment
				SET 
					device=:device,
					start=:start,
					stop=:stop,
					surcharge=:surcharge,
					discount=:discount,
					comment=:comment,
					status=:status,
					date=:date
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
					INTO payment(device, start, stop, surcharge, discount, comment, status, date)
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
		return false;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $payment_id
	 */
	public static function getTotal($payment_id) {
		$dbh = $GLOBALS['dbh'];
		
		$total1		= 0;
		$total2		= 0;
		$discount	= 0;
		$unit		= 1;
		
		$result = $dbh->query("
			SELECT 
				val
			FROM 
				system
			WHERE
				var='default_unit'
		");
		foreach ($result as $r) {
			$unit = (float) $r['val'];
		}
		$unit = $unit * 3600;
		
		$result = $dbh->query("
			SELECT 
				(P.stop - P.start) / $unit * D.cost + P.surcharge AS total, P.discount 
			FROM 
				payment P 
				INNER JOIN device D ON P.device=D.id 
			WHERE 
				P.id=$payment_id
		");
		foreach ($result as $r) {
			$total1		= $r['total'];
			$discount	= $r['discount'];
		}
		$result = $dbh->query("
			SELECT 
				SUM(PM.number * M.cost) as total
			FROM 
				payment_menu PM 
				INNER JOIN menu M ON M.id=PM.menu 
			GROUP BY 
				PM.payment 
			HAVING 
				PM.payment=$payment_id
		");
		foreach ($result as $r) {
			$total2 = $r['total'];
		}
		
		return array($total1 + $total2, $total1 + $total2 - $discount);
	}
}