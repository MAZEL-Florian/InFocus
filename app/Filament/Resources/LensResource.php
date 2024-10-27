<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LensResource\Pages;
use App\Filament\Resources\LensResource\RelationManagers;
use App\Models\Lens;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LensResource extends Resource
{
    protected static ?string $model = Lens::class;

    public static function getBreadcrumb(): string
    {
        return 'Objectifs';
    }

    public static function getNavigationLabel(): string
    {
        return 'Objectifs';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('focal_length')
                    ->label('Distance Focale')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price_wot')
                    ->label('Prix HT')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
                Forms\Components\TextInput::make('price')
                    ->label('Prix')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url'),
                Tables\Columns\TextColumn::make('focal_length')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_wot')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLenses::route('/'),
            'create' => Pages\CreateLens::route('/create'),
            'edit' => Pages\EditLens::route('/{record}/edit'),
        ];
    }
}
