<?php

abstract class Beverage {
	abstract function getPrice() : int;
	abstract function getVolume() : int;
}

class Coffee extends Beverage {
	private $price = 5;
	private $volume = 50;
	
	function getPrice(): int
	{
		return $this->price;
	}
	
	function getVolume(): int
	{
		return $this->volume;
	}
}

class Tea extends Beverage {
	private $price = 4;
	private $volume = 200;
	
	function getPrice(): int
	{
		return $this->price;
	}
	
	function getVolume(): int
	{
		return $this->volume;
	}
	
}

class MilkDecorator extends Beverage {
	protected $beverage;
	
	function __construct(Beverage $beverage)
	{
		$this->beverage = $beverage;
	}
	
	function getPrice(): int
	{
		return $this->beverage->getPrice() + 1;
	}
	
	function getVolume(): int
	{
		return $this->beverage->getVolume() + 20;
	}
}

class AmarettoDecorator extends Beverage {
	protected $beverage;
	
	function __construct(Beverage $beverage)
	{
		$this->beverage = $beverage;
	}
	
	function getPrice(): int
	{
		return $this->beverage->getPrice() + 5;
	}
	
	function getVolume(): int
	{
		return $this->beverage->getVolume() + 10;
	}
}
/**
 * Хочу молочный чай с ликером.
 */
$oneBeverage = new AmarettoDecorator(new MilkDecorator(new Tea()));

/**
 * Просто кофе с молоком.
 */
$anotherBeverage = new MilkDecorator(new Coffee());