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
                Forms\Components\TextInput::make('brand')
                    ->label('Marque')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_focal_length')
                    ->label('Distance Focale Minimum')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('max_focal_length')
                    ->label('Distance Focale Maximum')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_aperture')
                    ->label('Ouverture Minimum')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('max_aperture')
                    ->label('Ouverture Maximum')
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
                Forms\Components\FileUpload::make('image_url')
                    ->label('Image')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('brand')
                    ->label('Marque')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('min_focal_length')
                    ->label('Distance focale min.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_focal_length')
                    ->label('Distance focale max.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('min_aperture')
                    ->label('Ouverture min.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('max_aperture')
                    ->label('Ouverture max.')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_wot')
                    ->label('Prix HT')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Prix TTC')
                    ->money('EUR')
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
