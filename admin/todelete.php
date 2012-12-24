<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
include '../lib/interface/ICouponsDAO.php';
include '../lib/class/CouponsDAO.php';
include '../lib/class/Coupon.php';
include '../lib/class/CouponException.php';
include '../lib/class/Category.php';
include '../lib/class/Business.php';
	//include 'library.php';
	//A 'catch all' Function
	function generalExceptionHandler($e)
	{
		echo "<BR><B>General Error Message</B><BR>";
	}
	set_exception_handler("generalExceptionHandler");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Change contents dynamically of a select box depends on another select box using jquery ajax php and mysql</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<!-- http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js -->
<script type="text/javascript">
$(document).ready(function()
{
  $("#parent_category").change(function()
  {
    var pc_id = $(this).val();
	if(pc_id != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "todelete2.php",
		 data: "pc_id="+ pc_id,
		 success: function(option)
		 {
		   $("#child_category").html(option);
		 }
	  });
	 }
	 else
	 {
	   $("#child_category").html("<option value=''>-- No category selected change --</option>");
	 }
	return false;
  });
});
</script>

<script>
	function setButtonId(coupon_id){
		//alert(coupon_id);
		//document.delete.value = "Delete " + coupon_id;
		document.getElementById('delete').setAttribute('value', "Delete " + coupon_id);
        //document.getElementById('delete').innerHTML = "Delete - " + coupon_id;
	}
</script>

</head>

<body>
<?php
//include('db.php');
//$query = "select * from product_catg";
//$res   = mysql_query($query);
?>
<?php
	if (!isset($couponsDAO))
	{
		 $couponsDAO = couponsDAO::getInstance();
	}
?>
<?php $businessList = CouponsDAO::getBusinesses(); ?>

<?php //var_dump($businessList);?>
<span>Select Category:</span>&nbsp;&nbsp;
<select id="parent_category" name="parent_category">
 <?php 
     echo "<option value='0'>Select A Business</option>" ;           		    
     foreach ($businessList as $bus) { 
		echo "<option value=".  $bus->getId() . ">" .$bus->getName() ."</option>"; 
									} 
 ?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;<span>Available Brands:</span>&nbsp;&nbsp;
<select id="child_category" name="child_category" onchange="setButtonId(child_category.options[child_category.selectedIndex].value);">   
  
</select>

<input type="button" value="Delete Coupon" name="delete" id="delete" onClick="window.location='deleteCoupon.php?coupon_id=child_category.options[child_category.selectedIndex].value';">
</body>
</html>

<style>
span {
font-size:20px;
}
#parent_category,
#child_category {
border:3px solid #FF9900; 
-moz-border-radius:3px;
-webkit-border-radius:3px;
border-radius:3px; 
width:210px; 
height:35px; 
font-size:16px;
}
#tuto_link {
margin-bottom:50px;
}
#tuto_link a {
font-size:20px;
}
</style>