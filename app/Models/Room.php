<?php

namespace App\Models;

use App\Traits\RoomHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory, RoomHelper;
    protected $fillable = ['name', 'building_id'];
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
    public function appliance(): HasMany
    {
        return $this->hasMany(Appliance::class);
    }
}
