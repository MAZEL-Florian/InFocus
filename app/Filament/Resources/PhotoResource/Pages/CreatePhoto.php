<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use Intervention\Image\Laravel\Facades\Image;

class CreatePhoto extends CreateRecord
{
    protected static ?string $title = 'Créer une photo';

    protected static string $resource = PhotoResource::class;

    protected function handleRecordCreation(array $data): Photo
    {
        $photos = [];
        
        foreach ($data['image_url'] as $imagePath) {
            $img = Image::read('storage/' . $imagePath);
            $metaData = $img->exif();
    
            $make = $metaData->get('IFD0.Make') ?? null;
            $exposureTime = $metaData->get('EXIF.ExposureTime') ?? null;
            $iso = $metaData->get('EXIF.ISOSpeedRatings') ?? null;
            $focalLength = $metaData->get('EXIF.FocalLength') ?? null;
    
            $photo = Photo::create([
                'image_url' => $imagePath,
                'make' => $make,
                'exposure_time' => $exposureTime,
                'iso' => $iso,
                'focal_length' => $focalLength,
            ]);
    
            if (!empty($data['selected_photo_types'])) {
                $photo->photoTypes()->sync($data['selected_photo_types']);
            }
    
            $photos[] = $photo;
        }
    
        return end($photos);
    }
    
    
}
