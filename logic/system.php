<?php

include_once 'class/range.class.php';
include_once 'class/device.class.php';

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
	
	$common = $workbook->addFormat();
	$common->setFontFamily('Arial');
	$common->setSize(12);
	
	$caption = $workbook->addFormat();
	$caption->setFontFamily('Arial');
	$caption->setSize(12);
	$caption->setBorder(1);
	$caption->setFgColor('green');
	
	$row = $workbook->addFormat();
	$row->setFontFamily('Arial');
	$row->setSize(12);
	$row->setBorder(1);
	
	$sum = $workbook->addFormat();
	$sum->setFontFamily('Arial');
	$sum->setSize(12);
	$sum->setBorder(1);
	$sum->setBold();
	
	if ($_POST['report'] == 1) {
		$date = strtotime($_POST['date']);
		if ($_POST['device']) {
			$worksheet->write(0, 0, 'Báo cáo ngày', $header);
			$worksheet->setMerge(0, 0, 0, 5);
		} else {
			$worksheet->write(0, 0, 'Báo cáo ngày', $header);
			$worksheet->setMerge(0, 0, 0, 5);
			
			$worksheet->write(1, 4, 'Máy', $common);
			$worksheet->write(1, 5, 'Tất cả', $common);
			$worksheet->write(2, 4, 'Ngày báo cáo', $common);
			$worksheet->write(2, 5, date('d/m/Y'), $common);
			
			$worksheet->write(4, 0, 'STT', $caption);
			$worksheet->write(4, 1, 'Tên máy', $caption);
			$worksheet->write(4, 2, 'Tổng số giờ', $caption);
			$worksheet->write(4, 3, 'Tổng tiền giờ', $caption);
			$worksheet->write(4, 4, 'Tổng tiền phụ thu', $caption);
			$worksheet->write(4, 5, 'Tổng tiền', $caption);
			
			$index	= 5;
			$stt	= 1;
			$rows = Device::getDataReport(0, $date);
			foreach ($rows as $r) {
				$worksheet->write($index, 0, $stt, $row);
				$worksheet->write($index, 1, $r['name'], $row);
				$worksheet->write($index, 2, number_format($r['sumhour'], 2, ',', '.'), $row);
				$worksheet->write($index, 3, number_format($r['summoney'], 2, ',', '.'), $row);
				$worksheet->write($index, 4, number_format($r['summenu'], 2, ',', '.'), $row);
				$worksheet->write($index, 5, number_format($r['sumfinal'], 2, ',', '.'), $row);
				$index++;
				$stt++;
			}
			$worksheet->write($index, 4, 'Tổng tiền trong ngày', $sum);
			$worksheet->write($index, 5, 100, $sum);
		}
		
		$workbook->send('BaoCaoNgay_' . date('d-m-Y') . '.xls');
	} elseif($_POST['report'] == 2) {
		
		
		$workbook->send('BaoCaoTuan_' . date('d-m-Y') . '.xls');
	} else {
		
		
		$workbook->send('BaoCaoThang_' . date('d-m-Y') . '.xls');
	}
	$workbook->close();
}

$smarty->display('system.tpl');