<?php

namespace App\Traits;

trait RoomHelper
{
  public function calculatePowerForRoom()
  {
    return $this->appliance->sum('power');
  }
}
