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
	<title>Coupons List -edit mode</title>
	<LINK rel="stylesheet" type="text/css" href="../include/style/couponStyle.css">
</head>
<?php
$id =  $_POST["id"];
$categoryId 	= $_POST["categoryId"];
$businessId 	= $_POST["businessId"];
$name 			= $_POST["name"];
$description 	= $_POST["description"];
$imageFileName 	= $_POST["imageFileName"];

//echo $name;
//exit;
if($name != '')
{
	//add the new coupon to the DB

	$couponsDAO = couponsDAO::getInstance();
	//$dao = new CouponsDAO();
	$co = new Coupon($id,$categoryId, $businessId, $name, $description, $imageFileName);
	//Create the Coupon object (the id is an auto increment value by the table)
	//coupon = new Coupon(0, $categoryId, $businessId, $name, $description, $imageFileName);
	try
	{
		couponsDAO::updateCoupon($co);
		//$dao->addCoupon($co);

	}
	catch (CouponException $e)
	{
		echo $e->getMessage();
	}

	//show message
	$msg = "The coupon ". $name ."and" .$categoryId ."and".$businessId."and </br>".$description."and".$imageFileName." was registered successfully to the DB";

	//GET ALL COUPONS AND SHOW THEM ON THE SCREEN
	try
	{
		couponsDAO::getCoupons();
		//$vec = $dao->getCoupons();
		//$cat = $dao->getCategories();
	}
	catch (CouponException $e)
	{
		echo $e->getMessage();
	}

}
?>
<body>

<?php if($msg != '')
	echo "<tr><td colspan='2' class='message'>".$msg."</td></tr>";
?>
</body>
</html>