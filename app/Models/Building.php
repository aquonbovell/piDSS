<?php

namespace App\Models;

use App\Traits\BuildingHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory, BuildingHelper;
    protected $fillable = ['name','user_id' ,'annual_consumption'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function room(): HasMany
    {
        return $this->hasMany(Room::class);
    }
    public function system(): HasMany
    {
        return $this->hasMany(System::class);
    }
}
