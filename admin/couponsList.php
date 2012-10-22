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
	<title>Coupons List</title>
	<LINK rel="stylesheet" type="text/css" href="../include/style/couponeStyle.css">
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
					<td colspan="5" class="formTitle">
					רשימת קופונים
					</td>
				</tr>
				<?php if($msg != '')
					echo "<tr><td colspan='5' class='message'>".$msg."</td></tr>";	
				?>
				
				<tr>
					<td>קוד</td>
					<td>שם</td>
					<td>קטגוריה</td>
					<td>שם העסק</td>
					<td>עריכה</td>
				</tr>
				<?php 				
				//$vec = $dao->getCategories();
				
				foreach($coupons as $co)
				{
					//$category_name = $ob->getCategory_name();
					//echo "<tr><td>$category_name</td></tr>";
					echo "<tr title='".$co->getDescription()."'>";
					echo "<td>".$co->getId()."</td>";
					echo "<td>".$co->getName()."</td>";
					echo "<td>".$co->getCategory_id()."</td>";
					echo "<td>".$co->getBusiness_id()."</td>";
					echo "<td><form action='editCoupon.php' method='post'>";
					echo "<input type='hidden' id='id' name='id' value='".$co->getId()."'>";
					echo "<input type='submit' value='edit'></form></td>";
					echo "</tr>";
						
				}?>
			</table>
	</body>
</html>