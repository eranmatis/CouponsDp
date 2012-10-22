<?php
interface ICouponsDAO
{
	function getCoupon($id);
	function addCoupon(Coupon $coupon);
	function getCoupons($from,$howMany);
	function updateCoupon(Coupon $coupon);
	function getCategory($id);
	function getCategories();
	function connect();
	function disconnect(mysqli $dbConnection);
}

?>