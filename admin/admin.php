<!DOCTYPE html>
<?php 
include '../lib/interface/ICouponsDAO.php';
include '../lib/class/CouponsDAO.php';
include '../lib/class/Coupon.php';
include '../lib/class/CouponException.php';
include '../lib/class/Category.php';
	//include 'library.php';
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
	<title>Add Coupon</title>
	<LINK rel="stylesheet" type="text/css" href="../include/style/couponStyle.css"></head>

<?php
	$categoryId 	= $_POST["categoryId"];
	$businessId 	= $_POST["businessId"];
	$name 			= $_POST["name"];
	$description 	= $_POST["description"];
	$imageFileName 	= $_POST["imageFileName"];
	
	
	if($name != '')
	{
		//add the new coupon to the DB
		
		$couponsDAO = couponsDAO::getInstance();
		//$dao = new CouponsDAO();
		$co = new Coupon(NULL,$categoryId, $businessId, $name, $description, $imageFileName);
		//Create the Coupon object (the id is an auto increment value by the table)
	    //coupon = new Coupon(0, $categoryId, $businessId, $name, $description, $imageFileName);
		try 
		{
			couponsDAO::addCoupon($co);
			//$dao->addCoupon($co);
				
		}
		catch (CouponException $e)
		{
			echo $e->getMessage();
		}
		
		//show message
		$msg = "The coupon ". $name ." was registered successfully to the DB";
		
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
	
	
	
	// http://localhost/CouponsDP/admin/addCoupone.php
	//$_FILES
	//$_POST
	//$widthval = $_POST["widthval"];
	//$heightval =$_POST["heightval"];

?>
	<body>
		<form ENCTYPE="multipart/form-data" action='admin.php' method='post'>
			<table border="1" dir="ltr" >
				<tr>
					<td colspan="2" class="formTitle">
						Add a new Coupon
					</td>
				</tr>
				<?php if($msg != '')
					echo "<tr><td colspan='2' class='message'>".$msg."</td></tr>";	
				?>

				<tr>
					<td>category id:</td>
					<?php
						if (!isset($couponsDAO))
						{
							 $couponsDAO = couponsDAO::getInstance();
						}
					?>
					<?php $categoryList = couponsDAO::getCategories(); ?>
					<?php //var_dump($categoryList);?>
					<td>
						<select name="categoryId">
                      		<?php 
                      		    
                      			foreach ($categoryList as $cat) { 
					 				echo "<option value=" .  $cat->getCategory_id() . ">". $cat->getCategory_name() . "</option>"; 
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
					<td><input type='text' name='businessId' value="<?php echo $businessId; ?>"></td>
				</tr>
				<tr>
					<td>name:</td>
					<td><input type='text' name='name' value="<?php echo $name; ?>"></td>
				</tr>
				<tr>
					<td colspan="2">description:</td>
				</tr>
				<tr>
					<td colspan="2">
						<textarea name='description' cols="50" rows="10"><?php echo $description; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>image File Name:</td>
					<td><input type='text' name='imageFileName' value="<?php echo $imageFileName; ?>"></td>
				</tr>
				<tr>
					<td colspan="2">
						<input type=submit class="button">
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>