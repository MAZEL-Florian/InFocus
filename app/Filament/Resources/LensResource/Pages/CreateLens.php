<?php

namespace App\Filament\Resources\LensResource\Pages;

use App\Filament\Resources\LensResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLens extends CreateRecord
{
    protected static ?string $title = 'Créer un objectif';

    protected static string $resource = LensResource::class;
}
