<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoTypeResource\Pages;
use App\Filament\Resources\PhotoTypeResource\RelationManagers;
use App\Models\PhotoType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoTypeResource extends Resource
{
    protected static ?string $model = PhotoType::class;

    public static function getNavigationLabel(): string
    {
        return 'Types de photographie';
    }
    public static function getBreadcrumb(): string
    {
        return 'Types de photographie';
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
                    ->directory('phototypes-image')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                    Tables\Columns\ImageColumn::make('image_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListPhotoTypes::route('/'),
            'create' => Pages\CreatePhotoType::route('/create'),
            'edit' => Pages\EditPhotoType::route('/{record}/edit'),
        ];
    }
}
