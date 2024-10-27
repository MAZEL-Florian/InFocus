<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Photo extends Model
{
    use HasFactory;

    protected  static  function  boot()
    {
        parent::boot();

        static::creating(function  ($model)  {
            $model->uuid = (string) Str::uuid();
            // $model->slug_reference = (string) bin2hex(random_bytes(6));
        });
    }

    public function getRouteKeyName()
    {
        return "uuid";
    }

    protected $fillable = [
        'name', 'make', 'exposure_time', 'iso', 'focal_length'
    ];

    public function photoTypes()
    {
        return $this->hasMany(PhotoType::class);
    }

    public function model()
    {
        return $this->belongsTo(Model::class);
    }
}