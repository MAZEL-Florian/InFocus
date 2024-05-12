<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nouveaux utilisateurs', User::count())
                ->description('Nouveaux utilisateurs cette semaine')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->chart([1,3,5,10,20,40])
                ->color('success'),
            Stat::make('Bounce rate', '21%')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
