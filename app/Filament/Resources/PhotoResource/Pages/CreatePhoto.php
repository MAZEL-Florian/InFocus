<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class CreatePhoto extends CreateRecord
{
    protected static ?string $title = 'Créer une photo';

    protected static string $resource = PhotoResource::class;

    protected function handleRecordCreation(array $data): Photo
    {
        $photos = [];

        foreach ($data['image_url'] as $imagePath) {
            $img = Image::read('storage/' . $imagePath);
            // dd($img, $img->exif());

            $pathInfo = pathinfo($imagePath);
            $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
            $manager = new ImageManager(new Driver());
            $image = $manager->read('storage/' . $imagePath);
            $encoded = $image->toWebp(60)->save('storage/' . $webpPath);
            unlink('storage/' . $imagePath);
            $metaData = $img->exif();
            $photo = Photo::create([
                'image_url' => $webpPath,
                'make' => $metaData->get('IFD0.Make') ?? null,
                'exposure_time' => $metaData->get('EXIF.ExposureTime') ?? null,
                'iso' => $metaData->get('EXIF.ISOSpeedRatings') ?? null,
                'focal_length' => $metaData->get('EXIF.FocalLength') ?? null,
                'aperture' => $metaData->get('COMPUTED.ApertureFNumber') ?? null,
                'model_name' => $metaData->get('IFD0.Model') ?? null
            ]);

            if (!empty($data['photo_types'])) {
                $photo->photoTypes()->sync($data['photo_types']);
            }
            
            

            $photos[] = $photo;
        }

        return end($photos);
    }
}
