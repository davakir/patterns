<?php

abstract class Unit {
	
	abstract function getBombardStrength(): int;
	
	public function addUnit(Unit $unit) {
		throw new \Exception("I'm not a composite. Sorry...");
	}
	
	public function removeUnit(Unit $unit) {
		throw new Exception("I'm not a composite. Sorry...");
	}
}

/**
 * Class Army -- это композит
 */
class Army extends Unit {
	
	private $units;
	
	public function getBombardStrength() : int
	{
		$bStrength = 0;
		
		/** @var $unit Unit */
		foreach ($this->units as $unit) {
			$bStrength += $unit->getBombardStrength();
		}
		
		return $bStrength;
	}
	
	public function addUnit(Unit $unit)
	{
		if (in_array($unit, $this->units, true)) {
			return;
		}
		
		$this->units[] = $unit;
	}
	
	public function removeUnit(Unit $unit)
	{
		$this->units = array_udiff($this->units, [$unit], function ($a, $b) {
			return ($a === $b) ? 0 : 1;
		});
	}
}

/**
 * Class TroopCarrier -- это композит
 */
class TroopCarrier extends Unit {
	
	private $units;
	
	public function getBombardStrength() : int
	{
		$bStrength = 0;
		
		/** @var $unit Unit */
		foreach ($this->units as $unit) {
			$bStrength += $unit->getBombardStrength();
		}
		
		return $bStrength;
	}
	
	public function addUnit(Unit $unit)
	{
		if (in_array($unit, $this->units, true)) {
			return;
		}
		
		$this->units[] = $unit;
	}
	
	public function removeUnit(Unit $unit)
	{
		$this->units = array_udiff($this->units, [$unit], function ($a, $b) {
			return ($a === $b) ? 0 : 1;
		});
	}
}

class Soldier extends Unit {
	
	private $bombardStrength = 20;
	
	public function getBombardStrength(): int
	{
		return $this->bombardStrength;
	}
}

class LaserCannon extends Unit {
	
	private $bombardStrength = 60;
	
	public function getBombardStrength(): int
	{
		return $this->bombardStrength;
	}
}

