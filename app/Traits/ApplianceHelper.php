<?php namespace App\Traits;

use App\Models\Appliance;

trait ApplianceHelper
{
	public function getPowerConsumption(Appliance $appliance)
	{
		return $appliance->powerConsumption;
	}
}