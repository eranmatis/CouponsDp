<?php
class category
{
	private $category_id;
	private $category_name;

	public function __construct($id,$name)
	{
		$this->setCategory_id($id);
		$this->setCategory_name($name);
	}

	public function getCategory_id()
	{
		return $this->category_id;
	}

	public function setCategory_id($category_id)
	{
		$this->category_id = $category_id;
	}

	public function getCategory_name()
	{
		return $this->category_name;
	}

	public function setCategory_name($category_name)
	{
		$this->category_name = $category_name;
	}
}
?>