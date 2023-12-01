<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Equipment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['quantity', 'item_id', 'system_id'];

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
