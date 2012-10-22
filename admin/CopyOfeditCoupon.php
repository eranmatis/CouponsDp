<!DOCTYPE html>
<?php 
	include '../lib/interface/ICouponsDAO.php';
	include '../lib/class/CouponsDAO.php';
	include '../lib/class/Coupon.php';
	include '../lib/class/CouponException.php';
	include '../lib/class/Category.php';
	//A 'catch all' Function
	function generalExceptionHandler($e)
	{
		echo "<BR><B>General Error Message</B><BR>";
	}
	set_exception_handler("generalExceptionHandler");
?>
<html>
	
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>Edit Coupon</title>
	<LINK rel="stylesheet" type="text/css" href="../include/style/couponStyle.css">
</head>

<?php
	// get the coupon id from coupon list and validate it if it's number
	$dirtyCoupnId 	= $_POST["id"];
	if (filter_var($dirtyCoupnId,FILTER_VALIDATE_INT)) 
	{
		$cleanCoupnId = $dirtyCoupnId; 
	} else {
		throw new Exception("Need to be integer");
	}
		
		$couponsDAO = couponsDAO::getInstance();
		
		try 
		{
			$co=couponsDAO::getCoupon($cleanCoupnId);
			var_dump($co);
			couponsDAO::updateCoupon($co);
			
			//$dao->addCoupon($co);
				
		}
		catch (CouponException $e)
		{
			echo $e->getMessage();
		}
		

?>
	<body>
		<form ENCTYPE="multipart/form-data" action='admin.php' method='post'>
			<table border="1" dir="ltr" >
				
			</table>
		</form>
	</body>
</html>