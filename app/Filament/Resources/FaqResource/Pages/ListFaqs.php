<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFaqs extends ListRecords
{
    protected static string $resource = FaqResource::class;

    protected static ?string $title = 'Liste des FAQs';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
