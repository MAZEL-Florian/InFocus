<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Mount extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
        return "uuid";
    }

    protected $fillable = [
        'name',
        'brand',
    ];

    public function models()
    {
        return $this->belongsToMany(Model::class, 'model_mount');
    }

    public function lenses()
    {
        return $this->belongsToMany(Lens::class, 'lens_mount');
    }
}
