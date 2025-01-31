<?php

namespace App\Filament\Resources\MountResource\Pages;

use App\Filament\Resources\MountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMount extends EditRecord
{
    protected static string $resource = MountResource::class;

    protected static ?string $title = 'Editer une monture';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
