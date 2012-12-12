<!DOCTYPE html>
<?php 
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
	
?>
<html>
	
<head>
	<meta charset="UTF-8">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>Coupons List</title>
	<LINK rel="stylesheet" type="text/css" href="../include/style/couponStyle.css">
</head>
<?php
	//set from and howmany variables from the GUI.
	$from=0; //init value
	$howmany=25; //default value
	$couponsDAO = couponsDAO::getInstance();
	try
	{
		$coupons=couponsDAO::getCoupons($from,$howmany);
		//var_dump($coupons);
	
	}
	catch (CouponException $e)
	{
		echo $e->getMessage();
	}
?>
	
<body>
	<table border="1" dir="ltr" >
		<tr>
			<td colspan="6" class="formTitle">
			רשימת קופונים
			</td>
		</tr>
		<?php 
			$msg = $_GET["msg"];
			if($msg != '') 
			{
				echo "<tr><td colspan='6' class='message'>".$msg."</td></tr>";	
			}
		?>
		
		<tr>
			<td>קוד</td>
			<td>שם</td>
			<td>קטגוריה</td>
			<td>שם העסק</td>
			<td>תמונה</td>
			<td>עריכה</td>
		</tr>
		<?php 				
		//$vec = $dao->getCategories();
		
		foreach($coupons as $co)
		{
			//$category_name = $ob->getCategory_name();
			//echo "<tr><td>$category_name</td></tr>";
			$hasImage = False;
			$image;
			if($co->getImagefilename() != "") 
			{
				$image = "../res/images/coupons/".$co->getBusiness_id()."/".$co->getCategory_id()."/".$co->getImagefilename();
			}
			else
			{
				//Default image
				$image = "../res/images/coupons/noImage.png";
			}
			echo "<tr title='".$co->getDescription()."'>";
			echo "<td>".$co->getId()."</td>";
			echo "<td>".$co->getName()."</td>";
			//echo "<td>".$co->getCategory_id()."</td>";
			echo "<td>".couponsDAO::getCategory($co->getCategory_id())."</td>";
			//echo "<td>".$co->getBusiness_id()."</td>";
			echo "<td>".couponsDAO::getBusiness($co->getBusiness_id())."</td>";
			echo "<td><a href='".$image."' target='_blank' class='' title='".$co->getName()."'><img src='".$image."' border='0' alt='".$co->getName()."' title='".$co->getName()."' width='32' height='32'></a></td>";
			echo "<td><form action='editCoupon.php' method='post'>";
			echo "<input type='hidden' id='id' name='id' value='".$co->getId()."'>";
			echo "<input type='submit' value='edit'></form></td>";
			echo "</tr>";
				
		}?>
		
		<tr>
			<td><a href="admin.php">Add a new Coupon</a></td>
		</tr>
		<tr>
			<td>
				<input type="button" value="Export Coupons List to a Csv file" onClick="window.location='couponsListToCsv.php';">
			</td>
		</tr>
	</table>
</body>
</html>