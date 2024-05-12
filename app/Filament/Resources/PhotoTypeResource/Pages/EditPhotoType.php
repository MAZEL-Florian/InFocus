<?php

namespace App\Filament\Resources\PhotoTypeResource\Pages;

use App\Filament\Resources\PhotoTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhotoType extends EditRecord
{
    protected static string $resource = PhotoTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
