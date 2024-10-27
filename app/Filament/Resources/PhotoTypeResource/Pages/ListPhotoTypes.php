<?php

namespace App\Filament\Resources\PhotoTypeResource\Pages;

use App\Filament\Resources\PhotoTypeResource;
use App\Models\PhotoType;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPhotoTypes extends ListRecords
{
    protected static string $resource = PhotoTypeResource::class;

    protected static ?string $title = 'Liste des types de photographie';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
