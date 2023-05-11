<?php
class menu
{

	private $id;
	private $name;
	private $description;
	private $date;
	private $price;
	private $image;

	function __construct($id, $name, $description, $date, $price, $image)
	{
		$this->Id = $id;
		$this->Name = $name;
		$this->Description = $description;
		$this->Date = $date;
		$this->Price = $price;
		$this->Image = $image;
	}

	public function getName()
	{
		return $this->Name;
	}

	public function setName($name)
	{
		$this->Name = $name;
	}

	public function getDescription()
	{
		return $this->Description;
	}

	public function setDescription($description)
	{
		$this->Description = $description;
	}

	public function getDate()
	{
		return $this->Date;
	}

	public function setDate($date)
	{
		$this->Date = $date;
	}

	public function getPrice()
	{
		return $this->Price;
	}

	public function setPrice($price)
	{
		$this->Price = $price;
	}

	public function getImage()
	{
		return $this->Image;
	}

	public function setImage($image)
	{
		$this->Image = $image;
	}
	public function setId($id)
	{
		$this->Id = $id;
	}

	public function getId()
	{
		return $this->Id;
	}


}
?>