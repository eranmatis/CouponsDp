<?php 
	header('Content-Encoding: UTF-8');
	header('Content-type: text/csv; charset=UTF-8');
	header("Content-Disposition:attachment;filename=\"couponList".date("d-m-y")."-".date("H-i").".csv\"");
		
	echo "\xEF\xBB\xBF"; // UTF-8 BOM, fix the hebrew chars
	
	include '../lib/interface/ICouponsDAO.php';
	include '../lib/class/CouponsDAO.php';
	include '../lib/class/Coupon.php';
	include '../lib/class/CouponException.php';
	include '../lib/class/Category.php';
	include '../lib/class/Business.php';
	//A 'catch all' Function
	function generalExceptionHandler($e)
	{
		echo "<BR><B>General Error Message</B><BR>";
	}
	set_exception_handler("generalExceptionHandler");

	//set from and howmany variables from the GUI.
	$from=0; //init value
	$howmany=25; //default value
	$couponsDAO = couponsDAO::getInstance();
	try
	{
		$coupons=couponsDAO::getCoupons($from,$howmany);
		exportCouponsListToCsv($coupons);
		//fputcsvCouponsList($coupons);
	
	}
	catch (CouponException $e)
	{
		echo $e->getMessage();
	}
	
	function exportCouponsListToCsv($coupons)
	{
		$header_line = "Coupon Id,Coupon Name,Category,Business Name,Description\n";
		echo $header_line;
		foreach ($coupons as $co) {
			$lineArr = $co->getId().",". $co->getName().",". couponsDAO::getCategory($co->getCategory_id()).",". couponsDAO::getBusiness($co->getBusiness_id()).",". $co->getDescription()."\n";
			echo $lineArr;
		}
	}
	
	/**
	 * Save the file in the res/csv-export older by a date and time stamp
	 * Display in browser is bad doe.
	 */
	function fputcsvCouponsList($coupons)
	{
		$couponsListCsvFile = fopen('../res/csv-export/couponList'.date("d-m-y").'-'.date("H-i").'.csv', 'w');
		
		//Header Line
		$header_line = array('Coupon Id', 'Coupon Name', 'Category', 'Business Name', 'Description');
		fputcsv($couponsListCsvFile, $header_line);
		//Data Lines
		foreach ($coupons as $co) {
			fputcsv($couponsListCsvFile, array($co->getId(), $co->getName(), couponsDAO::getCategory($co->getCategory_id()), couponsDAO::getBusiness($co->getBusiness_id()), $co->getDescription()));
		}
		fclose($couponsListCsvFile);	
	}
?>
