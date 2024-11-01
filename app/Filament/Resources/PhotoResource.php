<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoResource\Pages;
use App\Filament\Resources\PhotoResource\RelationManagers;
use App\Models\Photo;
use App\Models\PhotoType;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    public static function getNavigationLabel(): string
    {
        return 'Photos';
    }
    public static function getBreadcrumb(): string
    {
        return 'Photos';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_url')
                    ->image()
                    ->label('Image')
                    ->multiple()
                    ->required()
                    ->directory('photos'),
                Forms\Components\Select::make('photo_type_id')
                    ->label('Type de Photographie')
                    ->multiple()
                    ->relationship('photoTypes', 'name')
                    ->options(PhotoType::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('make')
                    ->label('Marque')
                    ->searchable(),
                Tables\Columns\TextColumn::make('exposure_time')
                    ->label('Temps d\'exposition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('iso')
                    ->label('ISO')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('focal_length')
                    ->label('Distance Focale')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date de création')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Date de mise à jour')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('photoTypes.name')
                    ->label('Types de Photographie')
                    ->badge()
                    ->separator(', ')
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
            'index' => Pages\ListPhotos::route('/'),
            'create' => Pages\CreatePhoto::route('/create'),
            'edit' => Pages\EditPhoto::route('/{record}/edit'),
        ];
    }
}
