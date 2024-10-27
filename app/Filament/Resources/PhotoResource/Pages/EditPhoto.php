<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhoto extends EditRecord
{
    protected static string $resource = PhotoResource::class;

    protected static ?string $title = 'Éditer une photo';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
