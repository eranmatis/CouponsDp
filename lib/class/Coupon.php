<?php
class Coupon
{
	private $id;
	private $category_id;
	private $business_id;
	private $name;
	private $description;
	private $imagefilename;

	public function __construct($idVal,$categoryIdVal,$businessIdVal,$nameVal,$descriptionVal,$imagefilenameVal)
	{
		$this->setId($idVal);
		$this->setCategory_id($categoryIdVal);
		$this->setBusiness_id($businessIdVal);
		$this->setName($nameVal);
		$this->setDescription($descriptionVal);
		$this->setImagefilename($imagefilenameVal);
	}

	public function setId($idVal)
	{
		if($idVal>=0)
		{
			$this->id = $idVal;
		}
	}
	public function getId()
	{
		return $this->id;
	}

	public function setCategory_id($categoryIdVal)
	{
		$this->category_id = $categoryIdVal;
	}
	public function getCategory_id()
	{
		return $this->category_id;
	}

	public function getBusiness_id()
	{
		return $this->business_id;
	}

	public function setBusiness_id($businessIdVal)
	{
		$this->business_id = $businessIdVal;
	}
	public function setName($nameVal)
	{
		$this->name = $nameVal;
	}
	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($descriptionVal)
	{
		$this->description = $descriptionVal;
	}

	public function getImagefilename()
	{
		return $this->imagefilename;
	}

	public function setImagefilename($imagefilenameVal)
	{
		$this->imagefilename = $imagefilenameVal;
	}


}

?>