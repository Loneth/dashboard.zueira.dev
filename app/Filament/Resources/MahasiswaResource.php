<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Layout;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationGroup = 'Mahasiswa';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('NIM')
                    ->label('NIM')
                    ->required(),
                Forms\Components\TextInput::make('nama_mahasiswa')
                    ->label('Nama Mahasiswa')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\Toggle::make('prodi_id')
                //     ->required(),
                Forms\Components\Select::make('prodi_id')
                    ->label('Prodi')
                    ->default('71')
                    ->options(Prodi::all()->pluck('prodi_nama', 'prodi_id'))
                    ->searchable(),
                // Forms\Components\Toggle::make('semester')
                //     ->required(),
                Forms\Components\TextInput::make('semester')
                    ->label('Semester')
                    ->maxLength(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('NIM')
                    ->label('NIM')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_mahasiswa')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('prodi_id')
                    ->label('Prodi')
                    ->enum(Prodi::all()->pluck('prodi_nama', 'prodi_id')),
                Tables\Columns\TextColumn::make('semester'),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->label('Tanggal Dibuat')
                //     ->since(),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->label('Tanggal Diupdate')
                //     ->since(),
            ])->defaultSort('NIM')
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['nama_mahasiswa'];
    }

    // protected function getDefaultTableSortColumn(): ?string
    // {
    //     return 'NIM';
    // }

    // protected function getDefaultTableSortDirection(): ?string
    // {
    //     return 'asc';
    // }
}
