<?php

include_once 'class/range.class.php';
include_once 'class/device.class.php';
include_once 'class/payment.class.php';

$ranges = Range::getAll();

$smarty->assign('ranges', $ranges);
$smarty->assign('menu', 2);

// Report
if ($_POST['report']) {
	set_include_path(dirname(dirname(__FILE__)) . '/library/PEAR/');
	
	include_once 'Spreadsheet/Excel/Writer.php';
	
	$workbook = new Spreadsheet_Excel_Writer();
	$workbook->setVersion(8);
	$worksheet =& $workbook->addWorksheet('report');
	$worksheet->setInputEncoding('UTF-8');
	
	$header = $workbook->addFormat();
	$header->setFontFamily('Arial');
	$header->setSize(14);
	$header->setFgColor('blue');
	$header->setBold();
	$header->setHAlign('center');
	$header->setVAlign('center');
	$header->setColor('white');
	
	$common = $workbook->addFormat();
	$common->setFontFamily('Arial');
	$common->setSize(12);
	
	$caption = $workbook->addFormat();
	$caption->setFontFamily('Arial');
	$caption->setSize(12);
	$caption->setBorder(1);
	$caption->setFgColor('green');
	$caption->setColor('white');
	
	$row = $workbook->addFormat();
	$row->setFontFamily('Arial');
	$row->setSize(12);
	$row->setBorder(1);
	
	$sum = $workbook->addFormat();
	$sum->setFontFamily('Arial');
	$sum->setSize(12);
	$sum->setBorder(1);
	$sum->setBold();
	
	$unit	= Payment::getUnit();
	
	if ($_POST['report'] == 1) {
		$date = strtotime($_POST['date']);
		if ($_POST['device']) {
			$device = Device::getById($_POST['device']);
			
			$worksheet->write(0, 0, 'Báo cáo ngày', $header);
			$worksheet->setMerge(0, 0, 0, 7);
			
			$worksheet->write(1, 6, 'Máy', $common);
			$worksheet->write(1, 7, $device->get_name(), $common);
			$worksheet->write(2, 6, 'Ngày', $common);
			$worksheet->write(2, 7, date('d/m/Y', $date), $common);
			$worksheet->write(3, 6, 'Ngày báo cáo', $common);
			$worksheet->write(3, 7, date('d/m/Y'), $common);
			
			$worksheet->write(5, 0, 'STT', $caption);
			$worksheet->write(5, 1, 'Giờ bắt đầu', $caption);
			$worksheet->write(5, 2, 'Giờ kết thúc', $caption);
			$worksheet->write(5, 3, 'Tiền giờ', $caption);
			$worksheet->write(5, 4, 'Tiền phụ thu', $caption);
			$worksheet->write(5, 5, 'Tiền giảm giá', $caption);
			$worksheet->write(5, 6, 'Tiền thực đơn', $caption);
			$worksheet->write(5, 7, 'Tổng tiền', $caption);
			
			$index	= 6;
			$count	= 7;
			$stt	= 1;
				
			Device::deleteSpamData();
			$rows = Device::getDataForOneDevice($_POST['device'], $date);
			foreach ($rows as $r) {
				$worksheet->write($index, 0, $stt, $row);
				$worksheet->write($index, 1, date('H:i:s', $r['start']), $row);
				$worksheet->write($index, 2, date('H:i:s', $r['stop']), $row);
				$worksheet->write($index, 3, number_format(($r['stop'] - $r['start']) / $unit * $r['cost'], 2, '.', ''), $row);
				$worksheet->write($index, 4, number_format($r['surcharge'], 2, '.', ''), $row);
				$worksheet->write($index, 5, number_format($r['discount'], 2, '.', ''), $row);
				$worksheet->write($index, 6, number_format($r['summenu'], 2, '.', ''), $row);
				$worksheet->write($index, 7, "=D$count+E$count-F$count+G$count", $row);
				$index++;
				$count++;
				$stt++;
			}
			$worksheet->write($index, 6, 'Tổng tiền trong ngày', $sum);
			$count = $count - 1;
			$worksheet->write($index, 7, "=SUM(H6:H$count)", $sum);
			
		} else {
			$worksheet->write(0, 0, 'Báo cáo ngày', $header);
			$worksheet->setMerge(0, 0, 0, 7);
			
			$worksheet->write(1, 6, 'Máy', $common);
			$worksheet->write(1, 7, 'Tất cả', $common);
			$worksheet->write(2, 6, 'Ngày', $common);
			$worksheet->write(2, 7, date('d/m/Y', $date), $common);
			$worksheet->write(3, 6, 'Ngày báo cáo', $common);
			$worksheet->write(3, 7, date('d/m/Y'), $common);
			
			$worksheet->write(5, 0, 'STT', $caption);
			$worksheet->write(5, 1, 'Tên máy', $caption);
			$worksheet->write(5, 2, 'Tổng số giờ', $caption);
			$worksheet->write(5, 3, 'Tổng tiền giờ', $caption);
			$worksheet->write(5, 4, 'Tổng tiền phụ thu', $caption);
			$worksheet->write(5, 5, 'Tổng tiền giảm giá', $caption);
			$worksheet->write(5, 6, 'Tổng tiền thực đơn', $caption);
			$worksheet->write(5, 7, 'Tổng tiền', $caption);
			
			$index	= 6;
			$count	= 7;
			$stt	= 1;
			
			Device::deleteSpamData();
			$rows = Device::getDataReportForAllDevice($date);
			foreach ($rows as $r) {
				$worksheet->write($index, 0, $stt, $row);
				$worksheet->writeString($index, 1, $r['name'], $row);
				$worksheet->write($index, 2, number_format($r['sumhour'] / 3600, 2, '.', ''), $row);
				$worksheet->write($index, 3, number_format($r['sumhour'] / $unit * $r['cost'], 2, '.', ''), $row);
				$worksheet->write($index, 4, number_format($r['sumsurcharge'], 2, '.', ''), $row);
				$worksheet->write($index, 5, number_format($r['sumdiscount'], 2, '.', ''), $row);
				$worksheet->write($index, 6, number_format($r['summenu'], 2, '.', ''), $row);
				$worksheet->write($index, 7, "=D$count+E$count-F$count+G$count", $row);
				$index++;
				$count++;
				$stt++;
			}
			$worksheet->write($index, 6, 'Tổng tiền trong ngày', $sum);
			$count = $count - 1;
			$worksheet->write($index, 7, "=SUM(H6:H$count)", $sum);
		}
		
		$workbook->send('BaoCaoNgay_' . date('d-m-Y') . '.xls');
	} elseif($_POST['report'] == 2) {
		$date_from	= strtotime($_POST['date_from']);
		$date_to	= strtotime($_POST['date_to']);
		if ($_POST['device']) {
			$device = Device::getById($_POST['device']);
			
			$worksheet->write(0, 0, 'Báo cáo tuần', $header);
			$worksheet->setMerge(0, 0, 0, 7);
				
			$worksheet->write(1, 6, 'Máy', $common);
			$worksheet->write(1, 7, $device->get_name(), $common);
			$worksheet->write(2, 6, 'Từ ngày', $common);
			$worksheet->write(2, 7, date('d/m/Y', $date_from), $common);
			$worksheet->write(3, 6, 'Đến ngày', $common);
			$worksheet->write(3, 7, date('d/m/Y', $date_to), $common);
			$worksheet->write(4, 6, 'Ngày báo cáo', $common);
			$worksheet->write(4, 7, date('d/m/Y'), $common);
				
			$worksheet->write(6, 0, 'STT', $caption);
			$worksheet->write(6, 1, 'Giờ bắt đầu', $caption);
			$worksheet->write(6, 2, 'Giờ kết thúc', $caption);
			$worksheet->write(6, 3, 'Tiền giờ', $caption);
			$worksheet->write(6, 4, 'Tiền phụ thu', $caption);
			$worksheet->write(6, 5, 'Tiền giảm giá', $caption);
			$worksheet->write(6, 6, 'Tiền thực đơn', $caption);
			$worksheet->write(6, 7, 'Tổng tiền', $caption);
				
			$index	= 7;
			$count	= 8;
			$stt	= 1;
		
			Device::deleteSpamData();
			$rows = Device::getDataForOneDevice($_POST['device'], $date_from, $date_to);
			foreach ($rows as $r) {
				$worksheet->write($index, 0, $stt, $row);
				$worksheet->write($index, 1, date('H:i:s', $r['start']), $row);
				$worksheet->write($index, 2, date('H:i:s', $r['stop']), $row);
				$worksheet->write($index, 3, number_format(($r['stop'] - $r['start']) / $unit * $r['cost'], 2, '.', ''), $row);
				$worksheet->write($index, 4, number_format($r['surcharge'], 2, '.', ''), $row);
				$worksheet->write($index, 5, number_format($r['discount'], 2, '.', ''), $row);
				$worksheet->write($index, 6, number_format($r['summenu'], 2, '.', ''), $row);
				$worksheet->write($index, 7, "=D$count+E$count-F$count+G$count", $row);
				$index++;
				$count++;
				$stt++;
			}
			$worksheet->write($index, 6, 'Tổng tiền trong tuần', $sum);
			$count = $count - 1;
			$worksheet->write($index, 7, "=SUM(H6:H$count)", $sum);
				
		} else {
			$worksheet->write(0, 0, 'Báo cáo tuần', $header);
			$worksheet->setMerge(0, 0, 0, 7);
				
			$worksheet->write(1, 6, 'Máy', $common);
			$worksheet->write(1, 7, 'Tất cả', $common);
			$worksheet->write(2, 6, 'Từ ngày', $common);
			$worksheet->write(2, 7, date('d/m/Y', $date_from), $common);
			$worksheet->write(3, 6, 'Đến ngày', $common);
			$worksheet->write(3, 7, date('d/m/Y', $date_to), $common);
			$worksheet->write(4, 6, 'Ngày báo cáo', $common);
			$worksheet->write(4, 7, date('d/m/Y'), $common);
				
			$worksheet->write(6, 0, 'STT', $caption);
			$worksheet->write(6, 1, 'Tên máy', $caption);
			$worksheet->write(6, 2, 'Tổng số giờ', $caption);
			$worksheet->write(6, 3, 'Tổng tiền giờ', $caption);
			$worksheet->write(6, 4, 'Tổng tiền phụ thu', $caption);
			$worksheet->write(6, 5, 'Tổng tiền giảm giá', $caption);
			$worksheet->write(6, 6, 'Tổng tiền thực đơn', $caption);
			$worksheet->write(6, 7, 'Tổng tiền', $caption);
				
			$index	= 7;
			$count	= 8;
			$stt	= 1;
				
			Device::deleteSpamData();
			$rows = Device::getDataReportForAllDevice($date_from, $date_to);
			foreach ($rows as $r) {
				$worksheet->write($index, 0, $stt, $row);
				$worksheet->writeString($index, 1, $r['name'], $row);
				$worksheet->write($index, 2, number_format($r['sumhour'] / 3600, 2, '.', ''), $row);
				$worksheet->write($index, 3, number_format($r['sumhour'] / $unit * $r['cost'], 2, '.', ''), $row);
				$worksheet->write($index, 4, number_format($r['sumsurcharge'], 2, '.', ''), $row);
				$worksheet->write($index, 5, number_format($r['sumdiscount'], 2, '.', ''), $row);
				$worksheet->write($index, 6, number_format($r['summenu'], 2, '.', ''), $row);
				$worksheet->write($index, 7, "=D$count+E$count-F$count+G$count", $row);
				$index++;
				$count++;
				$stt++;
			}
			$worksheet->write($index, 6, 'Tổng tiền trong tuần', $sum);
			$count = $count - 1;
			$worksheet->write($index, 7, "=SUM(H6:H$count)", $sum);
		}
		
		$workbook->send('BaoCaoTuan_' . date('d-m-Y') . '.xls');
	} else {
		$month = $_POST['month'];
		$date_from	= strtotime($month . '/01/' . date('Y'));
		$date_to	= strtotime($month . '/31/' . date('Y'));
		if ($_POST['device']) {
			$device = Device::getById($_POST['device']);
				
			$worksheet->write(0, 0, 'Báo cáo tháng', $header);
			$worksheet->setMerge(0, 0, 0, 7);
		
			$worksheet->write(1, 6, 'Máy', $common);
			$worksheet->write(1, 7, $device->get_name(), $common);
			$worksheet->write(2, 6, 'Tháng', $common);
			$worksheet->write(2, 7, date('m/Y', $date_from), $common);
			$worksheet->write(3, 6, 'Ngày báo cáo', $common);
			$worksheet->write(3, 7, date('d/m/Y'), $common);
		
			$worksheet->write(5, 0, 'STT', $caption);
			$worksheet->write(5, 1, 'Giờ bắt đầu', $caption);
			$worksheet->write(5, 2, 'Giờ kết thúc', $caption);
			$worksheet->write(5, 3, 'Tiền giờ', $caption);
			$worksheet->write(5, 4, 'Tiền phụ thu', $caption);
			$worksheet->write(5, 5, 'Tiền giảm giá', $caption);
			$worksheet->write(5, 6, 'Tiền thực đơn', $caption);
			$worksheet->write(5, 7, 'Tổng tiền', $caption);
		
			$index	= 6;
			$count	= 7;
			$stt	= 1;
		
			Device::deleteSpamData();
			$rows = Device::getDataForOneDevice($_POST['device'], $date_from, $date_to);
			foreach ($rows as $r) {
				$worksheet->write($index, 0, $stt, $row);
				$worksheet->write($index, 1, date('H:i:s', $r['start']), $row);
				$worksheet->write($index, 2, date('H:i:s', $r['stop']), $row);
				$worksheet->write($index, 3, number_format(($r['stop'] - $r['start']) / $unit * $r['cost'], 2, '.', ''), $row);
				$worksheet->write($index, 4, number_format($r['surcharge'], 2, '.', ''), $row);
				$worksheet->write($index, 5, number_format($r['discount'], 2, '.', ''), $row);
				$worksheet->write($index, 6, number_format($r['summenu'], 2, '.', ''), $row);
				$worksheet->write($index, 7, "=D$count+E$count-F$count+G$count", $row);
				$index++;
				$count++;
				$stt++;
			}
			$worksheet->write($index, 6, 'Tổng tiền trong tháng', $sum);
			$count = $count - 1;
			$worksheet->write($index, 7, "=SUM(H6:H$count)", $sum);
		
		} else {
			$worksheet->write(0, 0, 'Báo cáo tháng', $header);
			$worksheet->setMerge(0, 0, 0, 7);
		
			$worksheet->write(1, 6, 'Máy', $common);
			$worksheet->write(1, 7, 'Tất cả', $common);
			$worksheet->write(2, 6, 'Tháng', $common);
			$worksheet->write(2, 7, date('m/Y', $date_from), $common);
			$worksheet->write(3, 6, 'Ngày báo cáo', $common);
			$worksheet->write(3, 7, date('d/m/Y'), $common);
		
			$worksheet->write(5, 0, 'STT', $caption);
			$worksheet->write(5, 1, 'Tên máy', $caption);
			$worksheet->write(5, 2, 'Tổng số giờ', $caption);
			$worksheet->write(5, 3, 'Tổng tiền giờ', $caption);
			$worksheet->write(5, 4, 'Tổng tiền phụ thu', $caption);
			$worksheet->write(5, 5, 'Tổng tiền giảm giá', $caption);
			$worksheet->write(5, 6, 'Tổng tiền thực đơn', $caption);
			$worksheet->write(5, 7, 'Tổng tiền', $caption);
		
			$index	= 6;
			$count	= 7;
			$stt	= 1;
		
			Device::deleteSpamData();
			$rows = Device::getDataReportForAllDevice($date_from, $date_to);
			foreach ($rows as $r) {
				$worksheet->write($index, 0, $stt, $row);
				$worksheet->writeString($index, 1, $r['name'], $row);
				$worksheet->write($index, 2, number_format($r['sumhour'] / 3600, 2, '.', ''), $row);
				$worksheet->write($index, 3, number_format($r['sumhour'] / $unit * $r['cost'], 2, '.', ''), $row);
				$worksheet->write($index, 4, number_format($r['sumsurcharge'], 2, '.', ''), $row);
				$worksheet->write($index, 5, number_format($r['sumdiscount'], 2, '.', ''), $row);
				$worksheet->write($index, 6, number_format($r['summenu'], 2, '.', ''), $row);
				$worksheet->write($index, 7, "=D$count+E$count-F$count+G$count", $row);
				$index++;
				$count++;
				$stt++;
			}
			$worksheet->write($index, 6, 'Tổng tiền trong tháng', $sum);
			$count = $count - 1;
			$worksheet->write($index, 7, "=SUM(H6:H$count)", $sum);
		}
		
		$workbook->send('BaoCaoThang_' . date('d-m-Y') . '.xls');
	}
	$workbook->close();
}

$smarty->display('system.tpl');