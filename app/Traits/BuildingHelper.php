<?php

namespace App\Traits;

trait BuildingHelper
{
  public function calculatePowerConsumption()
  {
    $rooms = $this->room;
    $totalPower = 0;
    foreach ($rooms as $room) {
      $totalPower += 
        $room->appliance->sum('power');
    }
    return $totalPower;
  }
}
