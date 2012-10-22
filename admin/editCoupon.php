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
	//set from and howmany variables from the GUI.
	//id_dirty - is the id of the selected coupon
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
	$coupon=couponsDAO::getCoupon($cleanCoupnId);
	//var_dump($coupons);

}
catch (CouponException $e)
{
	echo $e->getMessage();
}

 
?>
<body>
		<form ENCTYPE="multipart/form-data" action='updateCoupon.php' method='post'>
			<table border="1" dir="ltr" >
				<tr>
					<td colspan="2" class="formTitle">
						Edit a new Coupon
					</td>
				</tr>
				<?php if($msg != '')
					echo "<tr><td colspan='2' class='message'>".$msg."</td></tr>";	
				?>

				<tr>
					<td>category id:</td>
					<?php $categoryList = couponsDAO::getCategories(); ?>
					<?php //var_dump($categoryList);?>
					<td>
						<select name="categoryId">
                      		<?php 
                      		    
                      			foreach ($categoryList as $cat) { 
									$selected='';
									if ($cat->getCategory_id() == $coupon->getCategory_id())
									{
										$selected=' selected ';
									}
					 				echo "<option value=" .  $cat->getCategory_id() . " " . $selected .">". $cat->getCategory_name() . "</option>"; 
								} 
								//array(4) { 
								//[0]=> object(category)#4 (2) { ["category_id":"category":private]=> string(1) "1" ["category_name":"category":private]=> string(7) "clothes" } 
								//[1]=> object(category)#5 (2) { ["category_id":"category":private]=> string(1) "2" ["category_name":"category":private]=> string(9) "vications" } [2]=> object(category)#6 (2) { ["category_id":"category":private]=> string(1) "3" ["category_name":"category":private]=> string(6) "sports" } [3]=> object(category)#7 (2) { ["category_id":"category":private]=> string(1) "4" ["category_name":"category":private]=> string(5) "shows" } }
					 		?>
					 	</select> 
					</td>
				</tr>
				<tr>
					<td>business Id:</td>
					<td><input type='text' name='businessId' value="<?php echo $coupon->getBusiness_id(); ?>"></td>
				</tr>
				<tr>
					<td>name:</td>
					<td><input type='text' name='name' value="<?php echo $coupon->getName(); ?>"></td>
				</tr>
				<tr>
					<td colspan="2">description:</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name='description' cols="50" rows="10"><?php echo $coupon->getDescription(); ?></textarea>
					</td>
				</tr>
				<tr>
					<td>image File Name:</td>
					<td><input type='text' name='imageFileName' value="<?php echo $coupon->getImagefilename(); ?>"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type=submit class="button" value="updateCoupon.php?">
					</td>
				</tr>
			</table>
		</form>
</body>
</html>