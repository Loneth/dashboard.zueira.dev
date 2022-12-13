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
            ->schema(static::getFormSchema(Forms\Components\Card::class))
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);

        // return $form->schema([
        //     Forms\Components\Group::make()->schema([
        //         Forms\Components\Grid::make()->schema([
        //             Forms\Components\TextInput::make('id')
        //                 ->disabled(),
        //             Forms\Components\TextInput::make('Name')
        //                 ->required()
        //                 ->maxLength(60),
        //             Forms\Components\Textarea::make('Description')
        //                 ->columnSpan([
        //                     'sm' => 2,
        //                 ]),
        //         ])->columns([
        //             'sm' => 2,
        //         ]),
        //     ])->columnSpan([
        //         'sm' => 2,
        //     ]),
        // ])->columns([
        //     'sm' => 3,
        //     'lg' => null,
        // ]);

        // return $form
        //     ->schema([
        //         Forms\Components\TextInput::make('transaksi_kode')
        //             ->label('Kode Transaksi')
        //             ->placeholder('Akan di generate otomatis')
        //             ->disabled(),
        //         // Forms\Components\TextInput::make('transaksi_jumlah')
        //         //     ->required(),
        //         TextInput::make('transaksi_jumlah')
        //             ->label('Jumlah Transaksi')
        //             ->numeric()
        //             ->default('0')
        //             ->maxValue(100000000)
        //             ->mask(fn (TextInput\Mask $mask) => $mask
        //                 ->patternBlocks([
        //                     'money' => fn (Mask $mask) => $mask
        //                         ->numeric()
        //                         ->thousandsSeparator(',')
        //                         ->decimalSeparator('.'),
        //                 ])->pattern('money'),
        //         ),

                // // Forms\Components\TextInput::make('karyawan_id')
                // //     ->label('ID Karyawan')
                // //     ->required(),
                // Forms\Components\Select::make('karyawan_id')
                //     ->label('ID Karyawan')
                //     ->options(Karyawan::all()->pluck('karyawan_nama', 'karyawan_id'))
                //     ->searchable()
                //     ->required(),

                // // Forms\Components\TextInput::make('NIM')
                // //     ->label('NIM')
                // //     ->required(),
                // Forms\Components\Select::make('NIM')
                //     ->label('NIM')
                //     ->options(Mahasiswa::all()->pluck('nama_mahasiswa', 'NIM'))
                //     ->searchable()
                //     ->required(),
        //     ]);
    }

    public static function getFormSchema(string $layout = Forms\Components\Grid::class): array
    {
        return [
            Forms\Components\Group::make()->schema([
                $layout::make()->schema([
                    Forms\Components\TextInput::make('transaksi_kode')
                        ->label('Kode Transaksi')
                        ->placeholder('Akan di generate otomatis')
                        ->disabled(),
                    // TextInput::make('transaksi_jumlah')
                    //     ->label('Jumlah Transaksi')
                    //     ->numeric()
                    //     ->default('0')
                    //     ->maxValue(100000000)
                    //     ->mask(fn (TextInput\Mask $mask) => $mask
                    //         ->patternBlocks([
                    //             'money' => fn (Mask $mask) => $mask
                    //                 ->numeric()
                    //                 ->thousandsSeparator(',')
                    //                 ->decimalSeparator('.'),
                    //         ])->pattern('money'),
                    // ),
                    TextInput::make('transaksi_jumlah')->mask(fn (TextInput\Mask $mask) => $mask
                        ->money(prefix: 'Rp ', thousandsSeparator: ',', decimalPlaces: 2)),
                    Forms\Components\Select::make('karyawan_id')
                        ->label('ID Karyawan')
                        ->options(Karyawan::all()->pluck('karyawan_nama', 'karyawan_id'))
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('NIM')
                        ->label('NIM')
                        ->options(Mahasiswa::all()->pluck('nama_mahasiswa', 'NIM'))
                        ->searchable()
                        ->required(),
                    Forms\Components\Textarea::make('transaksi_catatan')
                        ->label('Catatan Transaksi')
                        ->columnSpan([
                            'sm' => 2,
                        ]),
                ])->columns([
                    'sm' => 2,
                ]),
            ])->columnSpan([
                'sm' => 2,
            ]),

            Forms\Components\Group::make()->schema([
                $layout::make()->schema([
                    Forms\Components\Group::make()->schema([
                        // Forms\Components\Toggle::make('transaksi_catatan')
                        //     ->required(),
                        Forms\Components\FileUpload::make('transaksi_bukti')
                            ->label('Bukti Transaksi')
                            ->image()
                            ->disk('app')
                            ->directory('form-attachments')
                            ->visibility('private'),
                    ]),
                ])->columns(1),
            ])
            ->columnSpan(1),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaksi_kode')
                    ->label('Kode Transaksi'),
                Tables\Columns\TextColumn::make('transaksi_catatan')
                    ->label('Catatan Transaksi')
                    // ->wrap(),
                    ->limit(50),
                Tables\Columns\TextColumn::make('karyawan_id')
                    ->label('ID Karyawan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('NIM')
                    ->label('NIM')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaksi_jumlah')
                    ->label('Jumlah Transaksi')
                    ->money('idr'),
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
