<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Str;

class Lens extends EloquentModel
{
    use HasFactory;

    protected  static  function  boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            // $model->slug_reference = (string) bin2hex(random_bytes(6));
        });
    }

    public function getRouteKeyName()
    {
        return "uuid";
    }
    protected $fillable = [
        'name',
        'focal_length',
        'price_wot',
        'price'
    ];

    public function models()
    {
        return $this->hasMany(Model::class);
    }

    public function mounts()
    {
        return $this->belongsToMany(Mount::class, 'lens_mount');
    }
}
