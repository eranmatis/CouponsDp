<?php
include '../lib/interface/ICouponsDAO.php';
include '../lib/class/CouponsDAO.php';
include '../lib/class/Coupon.php';
include '../lib/class/CouponException.php';
include '../lib/class/Category.php';
include '../lib/class/Business.php';

try
{

	if (!isset($couponsDAO))
	{
		 $couponsDAO = couponsDAO::getInstance();
	}
	//$vec = $dao->getCoupons();
	//$cat = $dao->getCategories();
}
catch (CouponException $e)
{
	echo $e->getMessage();
}


if(isset($_POST['pc_id']) && $_POST['pc_id'] != '')
{
  $pc_id = $_POST['pc_id'];
  //$pc_id = mysql_real_escape_string($pc_id);
  $couponList = CouponsDAO::getCouponsByBusiness($pc_id);
  //$res = mysql_query($couponList);
  //if(mysql_num_rows($res))
  //{
    //while($row = mysql_fetch_array($res))
	//{
		foreach ($couponList as $cup)
	  {
	  echo "<option value=".$cup->getId().">".ucfirst($cup->getName())."</option>";
	  }
  //}
}
?>