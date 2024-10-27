<?php

namespace App\Filament\Resources\LensResource\Pages;

use App\Filament\Resources\LensResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLenses extends ListRecords
{
    protected static string $resource = LensResource::class;

    protected static ?string $title = 'Liste des objectifs';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
