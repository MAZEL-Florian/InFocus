<?php

namespace App\Filament\Resources\PhotoTypeResource\Widgets;

use App\Models\PhotoType;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PhotoTypeOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nombre de type de photos', PhotoType::count())
                ->description('Nombre de type de photos valides')
                ->descriptionIcon('heroicon-s-camera', IconPosition::Before)
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
