<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'quantity', 'category', 'price'];
    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }

    public function equipments() : HasMany
    {
        return $this->hasMany(Equipment::class);
    }
}
