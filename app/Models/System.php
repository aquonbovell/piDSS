<?php

namespace App\Models;

use App\Traits\SystemHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class System extends Model
{
    use HasFactory, SystemHelper;
    protected $fillable = ['name', 'building_id','budget'];
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
    public function equipments() : HasMany
    {
        return $this->hasMany(Equipment::class);
    }
}
