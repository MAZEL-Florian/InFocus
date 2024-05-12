<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'advantages', 'disadvantages'
    ];

    public function packProducts()
    {
        return $this->hasMany(PackProduct::class);
    }
}
