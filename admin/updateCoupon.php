
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

	$id =  $_POST["id"];
	$categoryId 	= $_POST["categoryId"];
	$businessId 	= $_POST["businessId"];
	$name 			= $_POST["name"];
	$description 	= $_POST["description"];
	$imageFileName 	= $_POST["imageFileName"];

	//echo $name;
	//exit;
	if($id != '')
	{
		//Get the coupon
		//Create the Coupon object (the id is an auto increment value by the table)
		$couponsDAO = couponsDAO::getInstance();
		$co = new Coupon($id,$categoryId, $businessId, $name, $description, $imageFileName);
		
		try
		{
			couponsDAO::updateCoupon($co);
		}
		catch (CouponException $e)
		{
			echo $e->getMessage();
		}

		//show message
		$msg = "Coupon name: ". $name ."<br/>Category: " .$categoryId ."<br/> Business: ".$businessId."</br>Description: ".$description."<br/>Image name: ".$imageFileName."<br/>Was updated successfully!";
		header("Location: couponsList.php?msg=".$msg);
	}
?>