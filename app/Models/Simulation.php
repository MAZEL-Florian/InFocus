<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    use HasFactory;

    protected $fillable = [
       'photo_type_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
