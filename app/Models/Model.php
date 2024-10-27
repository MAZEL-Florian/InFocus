<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Model extends EloquentModel
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
        'name', 'camera_model', 'aperture', 'shutter_speed', 'iso', 'focal_length', 'price_wot', 'price'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function lenses()
    {
        return $this->hasMany(Lens::class);
    }
}
