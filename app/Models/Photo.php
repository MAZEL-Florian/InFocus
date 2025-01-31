<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Laravel\Facades\Image;

use Intervention\Image\Drivers\Gd\Driver;

class Photo extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'image_url' => 'array',
    // ];

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
        'image_url', 'make', 'exposure_time', 'iso', 'focal_length', 'model_id', 'lens_id', 'model_name'
    ];

    public function photoTypes()
    {
        return $this->belongsToMany(PhotoType::class, 'photo_type_photos');
    }
    


    public function model()
    {
        return $this->belongsTo(Model::class);
    }
}
