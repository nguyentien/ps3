<?php

set_include_path(dirname(dirname(__FILE__)) . '/library/PEAR/');

include_once 'Spreadsheet/Excel/Writer.php';

$a = new Spreadsheet_Excel_Writer();