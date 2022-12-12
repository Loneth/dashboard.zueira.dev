<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdiResource\Pages;
use App\Filament\Resources\ProdiResource\RelationManagers;
use App\Models\Prodi;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProdiResource extends Resource
{
    protected static ?string $model = Prodi::class;

    protected static ?string $navigationGroup = 'Mahasiswa';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('prodi_id')
                    ->label('ID Prodi')
                    ->required(),
                Forms\Components\TextInput::make('prodi_nama')
                    ->label('Nama Prodi')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('prodi_id')
                    ->label('ID Prodi'),
                Tables\Columns\TextColumn::make('prodi_nama')
                    ->label('Nama Prodi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->since(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Tanggal Diupdate')
                    ->since(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProdis::route('/'),
            'create' => Pages\CreateProdi::route('/create'),
            'edit' => Pages\EditProdi::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['prodi_nama'];
    }
}
