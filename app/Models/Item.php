<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'quantity', 'category', 'price'];
    public function attribute()
    {
        return $this->hasMany(Attribute::class);
    }
}
