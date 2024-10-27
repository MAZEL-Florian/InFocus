<?php

namespace App\Filament\Resources\LensResource\Pages;

use App\Filament\Resources\LensResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLens extends EditRecord
{
    protected static string $resource = LensResource::class;

    protected static ?string $title = 'Éditer un objectif';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
}
