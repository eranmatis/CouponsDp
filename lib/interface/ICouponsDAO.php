<?php
interface ICouponsDAO
{
	function getCoupon($id);
	function addCoupon(Coupon $coupon);
	function getCoupons($from,$howMany);
	function getCouponsByBusiness($id);
	function updateCoupon(Coupon $coupon);
	function getCategory($id);
	function getBusiness($id);
	function getCategories();
	function getBusinesses();
	function connect();
	function disconnect(mysqli $dbConnection);
	function deleteCoupon($id);
}

?>