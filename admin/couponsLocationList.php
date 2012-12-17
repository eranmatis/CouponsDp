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
	
	
	<script language="javascript">
		function setMyPosition() {
			if(window.navigator.geolocation) {
				window.navigator.geolocation.getCurrentPosition(myFunc,errfunc);
			} else {
				alert("geolocation is not supported");
			}
		}
		
		function myFunc(position)
		{
			document.getElementById('lat').value = position.coords.latitude;
			//document.getElementById('lat').setAttribute("value", position.coords.latitude);
			document.getElementById('long').value = position.coords.longitude;
			//document.getElementById('long').setAttribute("value", position.coords.longitude);
		}
		function errfunc(errorobject)
		{
			var message = errorobject.message;
			var code = errorobject.code;
			window.document.write(message + ", Error Code: " + code);
		}
		
		
		
		function distance(lon1, lat1, lon2, lat2) {
		  var R = 6371; // Radius of the earth in km
		  var dLat = (lat2-lat1).toRad();  // Javascript functions in radians
		  var dLon = (lon2-lon1).toRad(); 
		  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
				  Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) * 
				  Math.sin(dLon/2) * Math.sin(dLon/2); 
		  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
		  var d = R * c; // Distance in km
		  return d;
		}

		/** Converts numeric degrees to radians */
		if (typeof(Number.prototype.toRad) === "undefined") {
		  Number.prototype.toRad = function() {
			return this * Math.PI / 180;
		  }
		}
	</script>
	
	<?php
		$lat = $_POST['lat'];
		$long = $_POST['long'];
		//echo "lat= ". $lat . " long= ". $long;
	?>
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
	
<body onLoad="setMyPosition();">
	<form id="myLocationFrm" name="myLocationFrm" action="couponsLocationList.php" method="post">
		Lat: <input type="text" id="lat" name="lat" value="<?php $lat; ?>">
		Long: <input type="text" id="long" name="long" value="<?php $long; ?>">
		<input type="submit">
	</form>
	
	<script>
		function getBusDistance(cLong, cLat, busLongitude, busLatitude) {
			//alert(busLongitude + ", " + busLatitude);
			return distance(cLong, cLat, busLongitude, busLatitude);
			//return distance(34.777820999999996, 32.066157, busLongitude, busLatitude);
		}
	</script>
	
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
			<td>מרחק מבית העסק</td>
			
			<td>עריכה</td>
		</tr>
		<?php 				
		//$vec = $dao->getCategories();
		
		foreach($coupons as $co)
		{
			//Get The Business Data
			try
			{
				$bus=couponsDAO::getBusiness($co->getBusiness_id());
			}
			catch (CouponException $e)
			{
				echo $e->getMessage();
			}
	
			echo "<tr title='".$co->getDescription()."'>";
			echo "<td>".$co->getId()."</td>";
			echo "<td>".$co->getName()."</td>";
			echo "<td>".couponsDAO::getCategory($co->getCategory_id())."</td>";
			echo "<td>".$bus->getName()."</td>";
			echo "<td><script>document.write(getBusDistance(".$long.", ".$lat.", ".$bus->getLongtitude().", ".$bus->getLatitude()."));</script></td>";
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