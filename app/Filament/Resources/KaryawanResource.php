<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaryawanResource\Pages;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use App\Models\Karyawan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationGroup = 'Karyawan';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        // return $form
        //     ->schema([
        //         Forms\Components\TextInput::make('karyawan_id')
        //             ->required(),
        //         Forms\Components\TextInput::make('karyawan_nama')
        //             ->required()
        //             ->maxLength(255),
        //         Forms\Components\TextInput::make('karyawan_email')
        //             ->email()
        //             ->required()
        //             ->maxLength(255),
        //     ]);

        return $form->schema([
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('karyawan_id')
                    ->label('ID Karyawan')
                    ->required(),
                Forms\Components\TextInput::make('karyawan_nama')
                    ->label('Nama Karyawan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('karyawan_email')
                    ->label('Email Karyawan')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('karyawan_telp')
                    ->label('Nomor HP Karyawan')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('karyawan_id')
                    ->label('ID'),
                Tables\Columns\TextColumn::make('karyawan_nama')
                    ->label('Nama Karyawan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('karyawan_email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('karyawan_telp')
                    ->label('Nomor HP Karyawan'),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime(),
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
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['karyawan_nama'];
    }
}
