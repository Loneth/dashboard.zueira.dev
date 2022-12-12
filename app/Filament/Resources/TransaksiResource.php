<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Karyawan;
use App\Models\Mahasiswa;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationGroup = 'Karyawan';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('transaksi_kode')
                    ->label('Kode Transaksi')
                    ->placeholder('Akan di generate otomatis')
                    ->disabled(),
                // Forms\Components\TextInput::make('transaksi_jumlah')
                //     ->required(),
                TextInput::make('transaksi_jumlah')
                    ->label('Jumlah Transaksi')
                    ->numeric()
                    ->default('0')
                    ->maxValue(100000000)
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->thousandsSeparator(',')
                                ->decimalSeparator('.'),
                        ])->pattern('money'),
                ),

                // Forms\Components\TextInput::make('karyawan_id')
                //     ->label('ID Karyawan')
                //     ->required(),
                Forms\Components\Select::make('karyawan_id')
                    ->label('ID Karyawan')
                    ->options(Karyawan::all()->pluck('karyawan_nama', 'karyawan_id'))
                    ->searchable()
                    ->required(),

                // Forms\Components\TextInput::make('NIM')
                //     ->label('NIM')
                //     ->required(),
                Forms\Components\Select::make('NIM')
                    ->label('NIM')
                    ->options(Mahasiswa::all()->pluck('nama_mahasiswa', 'NIM'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaksi_kode')
                    ->label('Kode Transaksi'),
                Tables\Columns\TextColumn::make('karyawan_id')
                    ->label('ID Karyawan'),
                Tables\Columns\TextColumn::make('NIM')
                    ->label('NIM'),
                Tables\Columns\TextColumn::make('transaksi_jumlah')
                    ->label('Jumlah Transaksi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime(),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}
