<?php
include '../lib/interface/ICouponsDAO.php';
include '../lib/class/CouponsDAO.php';
include '../lib/class/Coupon.php';
include '../lib/class/CouponException.php';
include '../lib/class/Category.php';
//require 'library.php';

//function generalExceptionHandler($e)
//{
//	echo "<BR><B>General Error Message</B><BR>";
//}

//set_exception_handler("generalExceptionHandler");

//creating the data access object
$dao = new CouponsDAO();
echo "get number 1 only:".$dao->getCategory(1)."<br>";
$vec = $dao->getCategories();
echo "alll categoriy names : <br> <table border=1>";
echo "<tr><th>categoryname</th></tr>";
foreach($vec as $ob)
{
	//$category_name = $ob->getCategory_name();
		//echo "<tr><td>$category_name</td></tr>";
	echo "<tr><td>".$ob->getCategory_name()."</td></tr>";
}
echo "</table>";
//echo "getting all names of categories by get categories () func: ".$dao->getCategories();

//echo "this is coupon num 1:".$dao->getCoupon(2);

//adding new Coupon
/*try
{
	echo "about to add kishkashta Coupon to the db<br>";
	$co = new Coupon(5,2,1,"coupy-castro","clothes","clothimage");
	$dao->addCoupon($co);
	echo "cuppy-vecation - checking debug was added successfully";
}
catch(CouponException $e)
{
	echo $e->getMessage();
}

*/
//getting all Coupons and printing their details to the screen

/*$vec = $dao->getCoupons();
echo "<table border=1>";
echo "<tr><th>id</th><th>category-id</th><th>name</th></tr>";
foreach($vec as $ob)
{
	$id = $ob->getId();
	$category_id = $ob->getCategory_id();
	$name = $ob->getName();
	
	
	echo "<tr><td>$id</td><td>$category_id</td><td>$name</td></tr>";
}
echo "</table>";*/
//$vec = $dao->getCategory(1);
//echo "the category of 1 is ".$vec;

?>