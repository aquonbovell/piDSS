<?php

namespace App\Traits;

trait BuildingHelper
{
  public function calculatePowerConsumption()
  {
    $rooms = $this->room;
    $totalPower = 0;
    foreach ($rooms as $room) {
      $totalPower += 9;
        // $room->appliance->sum('powerConsumption');
    }
    return $totalPower;
  }
}
