<?php
include '../interface/ICouponsDAO.php';


class CouponsDAO implements ICouponsDAO
{
	private static $single;

	private function __construct() {
	}

	public static function getInstance()
	{
		if(self::$single==null)
		{
			self::$single = new CouponsDAO();
		}
		return CouponsDAO::$single;
	}

	function connect()
	{
		$mysqli = new mysqli();
		try
		{
			$mysqli -> connect("127.0.0.1","coupy","coup56","coupons");
		}
		catch (mysqli_sql_exception $e)
		{
			echo $e->getMessage();
		}

		$mysqli->set_charset("utf8");
		return $mysqli;
	}
	function disconnect(mysqli $dbConnection)
	{
		try
		{
			$dbConnection -> close();
		}
		catch (mysqli_sql_exception $e)
		{
			echo $e->getMessage();
		}
	}
	function getCoupons($from,$howMany)
	{
		//check vlidate argument
		if (!isset($from))		{
			$from=0;
		}
		if (!isset($howMany))		{
			$howMany=25;
		}
		//creating a connection
		//$ob = new mysqli("127.0.0.1","coupy","coup56","coupons");

		//creating the sql statement

		$mysqlDbCon = CouponsDAO::connect();
		$str = "SELECT * FROM coupons LIMIT ".$from.",".$howMany;
		//performing the query
		$result = $mysqlDbCon->query($str,MYSQLI_STORE_RESULT);

		//iterating the rows
		$vec = array();
		$index = 0;
		while(list($id,$category_id,$business_id,$name,$description,$imagefilename) = $result->fetch_row())
		{
			//echo "<tr><td>$id</td><td>$name</td><td>$length</td></tr>";
			$vec[$index] = new Coupon($id,$category_id,$business_id,$name,$description,$imagefilename);
			$index++;
		}

		//closing the connection
		CouponsDAO::disconnect($mysqlDbCon);

		return $vec;
	}

	/**
	 * @author
	 * (non-PHPdoc)
	 * @see ICouponsDAO::getCategories()
	 */
	function getCategories()
	{
		//echo " before db";
		$mysqlDbCon = CouponsDAO::connect();
		$str = "SELECT category_id, category_name FROM categories";
		$result = $mysqlDbCon->query($str,MYSQLI_STORE_RESULT);
		//iterating the rows
		$vec = array();
		$index = 0;
		while(list($id,$categoryname) = $result->fetch_row())
		{
			//echo "<tr><td>$id</td><td>$categoryname</td></tr>";
			$vec[$index] = new Category($id, $categoryname);
			$index++;
		}//closing the connection
		return $vec;
		CouponsDAO::disconnect($mysqlDbCon);

	}
	/**
	 * @param Coupon $ob
	 * 1. open DB connection
	 * 2. create/execute sql statement
	 * 3. close DB connection
	 * 4. return with success/fail message
	 */
	function addCoupon(Coupon $coupon)
	{
		$mysqlDbCon = CouponsDAO::connect();
		$stmt = $mysqlDbCon->prepare("INSERT INTO coupons (category_id,business_id,name,description,imagefilename) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param('iisss', $coupon->getCategory_id(), $coupon->getBusiness_id(), $coupon->getName(), $coupon->getDescription(), $coupon->getImagefilename());
		try
		{
			$stmt->execute();
		}
		catch (mysqli_sql_exception $e)
		{
			echo $e->getMessage();
		}

		printf ("New Record has id %d.\n", $mysqlDbCon->insert_id);
		//$query = "INSERT INTO tb_coupons (categoryId, businessId, name, description, imageFileName) ";
		//$query = $query . "	VALUES (".$ob->getCategoryId() .", ". $ob->getBusinessId() .", '". $ob->getName() ."', '". $ob->getDescription() ."', '". $ob->getImageFileName()."')";
		//echo "query= ". $query. "<br/>";
		//$mysqlDbCon->query($query);

		//Close the connection to the DB
		CouponsDAO::disconnect($mysqlDbCon);

	}
	function getCoupon($id)
	{
		//throw new MovieException("unimplemented method!");
		$mysqlDbCon = CouponsDAO::connect();
		$query = "SELECT * FROM coupons WHERE id = ".$id;
		try
		{
			$result = $mysqlDbCon->query($query,MYSQLI_STORE_RESULT);
			//$vec=array();
			//$index=++;
				
		}
		catch (mysqli_sql_exception $e)
		{
			echo $e->getMessage();
		}

		while(list($id, $categoryIdVal, $businessIdVal, $nameVal, $descriptionVal, $imagefilenameVal) = $result->fetch_row())
		{
				
			$coupon = new Coupon($id, $categoryIdVal, $businessIdVal, $nameVal, $descriptionVal, $imagefilenameVal);
			//printf("%s,%s<br>",$id,$name);
			//$theCoupon = new Coupon();
			return $coupon;
				
		}

		//Close the connection to the DB
		CouponsDAO::disconnect($mysqlDbCon);

	}
	function updateCoupon(Coupon $coupon)
	{
		throw new MovieException("unimplemented method!");
	}
	function getCategory($id)
	{
		//$category_id = $coupon->getCategory_id();
		//creating a connection
		//$ob = new mysqli("127.0.0.1","coupy","coup56","coupons");
		$mysqlDbCon = CouponsDAO::connect();

		//creating the sql statement
		$str = "SELECT category_name FROM categories WHERE category_id = ".$id;
		try
		{
			//performing the query
			$result = $mysqlDbCon->query($str,MYSQLI_STORE_RESULT);
		}
		catch (mysqli_sql_exception $e)
		{
			echo $e->getMessage();
		}
		while(list($name) = $result->fetch_row())
		{
			//printf("%s<br>",$name);
			return $name;
		}
		//Close the connection to the DB
		CouponsDAO::disconnect($mysqlDbCon);

	}
}
?>