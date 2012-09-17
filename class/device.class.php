<?php

class Device {
	// Property
	private $id;
	private $uid;
	private $name;
	private $cost;
	private $range;
	private $status;
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
	 * @param unknown_type $uid
	 */
	public function set_uid($uid) {
		$this->uid = $uid;
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
	 * @param unknown_type $cost
	 */
	public function set_cost($cost) {
		$this->cost = $cost;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $range
	 */
	public function set_range($range) {
		$this->range = $range;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_id() {
		return $this->id;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_uid() {
		return $this->uid;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_name() {
		return $this->name;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_cost() {
		return $this->cost;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return unknown_type
	 */
	public function get_range() {
		return $this->range;
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
	 */
	public function get_status() {
		return $this->status;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @return multitype:Device
	 */
	public static function getAll() {
		// Get connect db
		$dbh = $GLOBALS['dbh'];
		
		$rows = array();
		$sql = "
			SELECT 
				D.*,
				R.name as range_name
			FROM 
				device D
			LEFT JOIN `range` R ON D.range=R.id
		";
		foreach ($dbh->query($sql) as $row) {
			$count = count($rows);
			$rows[$count]['id']			= $row['id'];
			$rows[$count]['uid']		= $row['uid'];
			$rows[$count]['name']		= $row['name'];
			$rows[$count]['cost']		= $row['cost'];
			$rows[$count]['range_id']	= $row['range'];
			$rows[$count]['range_name']	= $row['range_name'];
			$rows[$count]['status']		= $row['status'];
		}
		
		return $rows;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param Device $d
	 */
	public static function save(Device $d) {
		$dbh = $GLOBALS['dbh'];
		
		if ($d->get_id()) {
			// Update
			$data = $dbh->prepare("
				UPDATE 
					device
				SET 
					uid=:uid, name=:name, cost=:cost, `range`=:range, `status`=:status
				WHERE 
					id=:id
			");
			$data->execute(array(
				':uid'		=> $d->get_uid(),
				':name'		=> $d->get_name(),
				':cost'		=> $d->get_cost(),
				':range'	=> $d->get_range(),
				':status'	=> $d->get_status(),
				':id'		=> $d->get_id()
			));
		} else {
			// Insert
			$data = $dbh->prepare("
				INSERT 
					INTO device (uid, name, cost, `range`)
				VALUES
					(:uid, :name, :cost, :range)
			");
			$data->execute(array(
				':uid' => $d->get_uid(),
				':name' => $d->get_name(),
				':cost' => $d->get_cost(),
				':range' => $d->get_range()
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
				device
			WHERE 
				id = :id
		");
		$data->execute(array(
			':id' => $id
		));
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public static function deleteSpamData() {
		$dbh = $GLOBALS['dbh'];
		
		$data = $dbh->prepare("
			DELETE
			FROM
				payment
			WHERE
				stop=0
		");
		$data->execute();
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param int $id
	 */
	public static function getById($id) {
		$dbh = $GLOBALS['dbh'];
		
		$sql = "
			SELECT 
				*
			FROM 
				device
			WHERE 
				id=$id
		";
		foreach ($dbh->query($sql) as $r) {
			$d = new Device();
			$d->set_id($id);
			$d->set_name($r['name']);
			$d->set_uid($r['uid']);
			$d->set_cost($r['cost']);
			$d->set_range($r['range']);
			$d->set_status($r['status']);
		}
		return $d;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param int $id
	 * @param int $date
	 * @param int $date1
	 */
	public static function getDataForOneDevice($id, $date, $date1) {
		$dbh = $GLOBALS['dbh'];
		
		$date_start	= strtotime(date('d', $date) . '-' . date('m', $date) . '-' . date('Y', $date) . ' 00:00:00');
		$date_stop	= strtotime(date('d', $date) . '-' . date('m', $date) . '-' . date('Y', $date) . ' 23:59:59');
		if ($date1) {
			$date_stop	= strtotime(date('d', $date1) . '-' . date('m', $date1) . '-' . date('Y', $date1) . ' 23:59:59');
		}
		
		$sql = "
			SELECT
				P.`start`,
				P.`stop`,
				D.cost,
				P.`surcharge`,
				P.`discount`,
				SUM(PM.`number`*M.`cost`) AS summenu
			FROM
				`payment` P
				INNER JOIN `device` D ON D.`id`=P.`device`
				INNER JOIN `payment_menu` PM ON P.`id`=PM.`payment`
				INNER JOIN `menu` M ON M.`id`=PM.`menu`
			WHERE
				P.`device`=$id
				AND P.`date` BETWEEN $date_start AND $date_stop
			GROUP BY
				P.id
		";
		$rows = array();
		foreach ($dbh->query($sql) as $r) {
			$index = count($rows);
			$rows[$index]['start'] = $r['start'];
			$rows[$index]['stop'] = $r['stop'];
			$rows[$index]['cost'] = $r['cost'];
			$rows[$index]['surcharge'] = $r['surcharge'];
			$rows[$index]['discount'] = $r['discount'];
			$rows[$index]['summenu'] = $r['summenu'];
		}
		
		return $rows;
	}
	/**
	 * 
	 * Get data for report
	 * @param int $id
	 * @param int $date
	 * @param int $date1
	 */
	public static function getDataReportForAllDevice($date, $date1) {
		$dbh = $GLOBALS['dbh'];
		
		$date_start	= strtotime(date('d', $date) . '-' . date('m', $date) . '-' . date('Y', $date) . ' 00:00:00');
		$date_stop	= strtotime(date('d', $date) . '-' . date('m', $date) . '-' . date('Y', $date) . ' 23:59:59');
		if ($date1) {
			$date_stop	= strtotime(date('d', $date1) . '-' . date('m', $date1) . '-' . date('Y', $date1) . ' 23:59:59');
		}
		
		$sql = "
			SELECT
				D.name,
				SUM(P.stop-P.start) AS sumhour,
				D.cost,
				SUM(P.surcharge) as sumsurcharge,
				SUM(P.discount) as sumdiscount,
				SUM(PM.number*M.cost) AS summenu
			FROM
				device D
				LEFT JOIN payment P ON D.id=P.device AND P.`date` BETWEEN $date_start AND $date_stop
				LEFT JOIN payment_menu PM ON P.id=PM.payment
				LEFT JOIN menu M ON M.id=PM.menu
			GROUP BY
				D.id
		";
		$rows = array();
		foreach ($dbh->query($sql) as $r) {
			$index = count($rows);
			$rows[$index]['name'] = $r['name'];
			$rows[$index]['sumhour'] = $r['sumhour'];
			$rows[$index]['cost'] = $r['cost'];
			$rows[$index]['sumsurcharge'] = $r['sumsurcharge'];
			$rows[$index]['sumdiscount'] = $r['sumdiscount'];
			$rows[$index]['summenu'] = $r['summenu'];
		}
		
		return $rows;
	}
}