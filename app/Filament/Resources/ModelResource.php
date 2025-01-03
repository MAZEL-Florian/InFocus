<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ModelResource\Pages;
use App\Filament\Resources\ModelResource\RelationManagers;
use App\Models\Model;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ModelResource extends Resource
{
    protected static ?string $model = Model::class;

    public static function getBreadcrumb(): string
    {
        return 'Boîtiers';
    }

    public static function getNavigationLabel(): string
    {
        return 'Boîtiers';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nom')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_url')
                    ->label('Image')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('brand')
                    ->label('Marque')
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('brand')
                    ->label('Marque')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_wot')
                    ->label('Prix HT')
                    ->money('EUR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Prix')
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
            'index' => Pages\ListModels::route('/'),
            'create' => Pages\CreateModel::route('/create'),
            'edit' => Pages\EditModel::route('/{record}/edit'),
        ];
    }
}
