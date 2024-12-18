<?php

namespace App\Filament\Resources\PhotoTypeResource\Pages;

use App\Filament\Resources\PhotoTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePhotoType extends CreateRecord
{
    protected static ?string $title = 'Créer un type de photographie';

    protected static string $resource = PhotoTypeResource::class;
}
