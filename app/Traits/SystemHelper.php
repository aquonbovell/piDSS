<?php

namespace App\Traits;

trait SystemHelper
{
  public function calculateTotalCost()
  {
    $equipments = $this->equipments;
    $totalCost = 0;
    foreach ($equipments as $equipment) {
      $totalCost +=
        $equipment->item->price * $equipment->quantity;
    }
    return $totalCost;
  }

  public function calculateTotalEnergy()
  {
    $equipments = $this->equipments;
    $totalCost = 0;
    foreach ($equipments as $equipment) {
      if ($equipment->item->category === 'solar panel')
        $totalCost +=
          // $equipment->item->wattage * $equipment->quantity;
          190 * $equipment->quantity;
    }
    return $totalCost;
  }

  public function calculateROI()
  {
    $totalCost = $this->calculateTotalCost();
    $estimantedEnergy = $this->calculateTotalEnergy();
    if ($estimantedEnergy == 0 || $totalCost == 0) {
      return 0;
    } else {
      $annual_savings = $estimantedEnergy * .28;
      $roi = $totalCost / ($annual_savings - $totalCost);
      return $roi;
    }
  }
}
