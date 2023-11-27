<?php

namespace App\Policies;

use App\Models\Building;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RoomPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Room $room): bool
    {
        return $user->id == $room->building->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $buildingId = Session::get('building_id');
        if ($buildingId) {
            $building = Building::find($buildingId);
            return $building && $user->id === $building->user_id;
        }
        return false;
    }
    
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Room $room): bool
    {
        return $user->id === $room->building->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Room $room): bool
    {
        return $user->id === $room->building->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Room $room): bool
    {
        return $user->id === $room->building->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Room $room): bool
    {
        return $user->id === $room->building->user_id;
    }
}
