<?php
/**
 * id, name, street, number, city, zip, telephone, latitude and longtitude
 * @author lab103
 * 
 * How to use MySQL Spatial Extensions 
 * http://howto-use-mysql-spatial-ext.blogspot.co.il/
 * 
 * Creating Geospatial Searches
 * http://emad.fano.us/blog/?p=211
 * 
 * INSERT INTO mytable (… , coordinates) VALUES (… , GeomFromText(’POINT($latitude $longitude)’))
 */
class Business
{
	private $id;			//The business id
	private $name;			//The business name
	private $street;		//The business street
	private $number;		//The business number
	private $city;			//The business city
	private $zip;			//The business zip
	private $telephone;		//The business telephone
	private $latitude;		//The business latitude
	private $longtitude;	//The business longtitude

	function __construct($idVal, $nameVal, $streetVal, $numberVal, $cityVal, $zipVal, $telephoneVal, $latitudeVal, $longtitudeVal)
	{
		$this->setId($idVal);
		$this->setName($nameVal);
		$this->setStreet($streetVal);
		$this->setNumber($numberVal);
		$this->setCity($cityVal);
		$this->setZip($zipVal);
		$this->setTelephone($telephoneVal);
		$this->setLatitude($latitudeVal);
		$this->setLongtitude($longtitudeVal);
	}

	function __toString()
	{
		return "Implement toString on Business or use IPrintable interface...";
	}

	function __invoke()
	{

	}

	function __sleep()
	{

	}

	function __wakeup()
	{

	}
	/**
	 *
	 * @return
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 *
	 * @param $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 *
	 * @return
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 *
	 * @param $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 *
	 * @return
	 */
	public function getStreet()
	{
		return $this->street;
	}

	/**
	 *
	 * @param $street
	 */
	public function setStreet($street)
	{
		$this->street = $street;
	}

	/**
	 *
	 * @return
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 *
	 * @param $number
	 */
	public function setNumber($number)
	{
		$this->number = $number;
	}

	/**
	 *
	 * @return
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 *
	 * @param $city
	 */
	public function setCity($city)
	{
		$this->city = $city;
	}

	/**
	 *
	 * @return
	 */
	public function getZip()
	{
		return $this->zip;
	}

	/**
	 *
	 * @param $zip
	 */
	public function setZip($zip)
	{
		$this->zip = $zip;
	}

	/**
	 *
	 * @return
	 */
	public function getTelephone()
	{
		return $this->telephone;
	}

	/**
	 *
	 * @param $telephone
	 */
	public function setTelephone($telephone)
	{
		$this->telephone = $telephone;
	}

	/**
	 *
	 * @return
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}

	/**
	 *
	 * @param $latitude
	 */
	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	}

	/**
	 *
	 * @return
	 */
	public function getLongtitude()
	{
		return $this->longtitude;
	}

	/**
	 *
	 * @param $longtitude
	 */
	public function setLongtitude($longtitude)
	{
		$this->longtitude = $longtitude;
	}

}
?>