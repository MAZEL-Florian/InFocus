<?php

namespace App\Filament\Resources\ModelResource\Pages;

use App\Filament\Resources\ModelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModel extends CreateRecord
{
    protected static ?string $title = 'Créer un boîtier';

    protected static string $resource = ModelResource::class;
}
