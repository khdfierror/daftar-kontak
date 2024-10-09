<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KontakPerusahaanResource\Pages;
use App\Filament\Resources\KontakPerusahaanResource\RelationManagers;
use App\Models\KontakPerusahaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KontakPerusahaanResource extends Resource
{
    protected static ?string $model = KontakPerusahaan::class;

    protected static ?string $navigationIcon = 'carbon-email';

    protected static ?string $navigationLabel = 'Kontak Perusahaan';

    protected static ?string $pluralLabel = 'Kontak Perusahaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kontak_id')
                    ->label('Kontak')
                    ->relationship(
                        name: 'kontak',
                        titleAttribute: 'nama_depan',
                    )
                    ->searchable()
                    ->required()
                    ->validationMessages([
                        'required' => '*Kontak Wajib di Pilih',
                    ])
                    ->preload()
                    ->native(false)
                    ->columnSpanFull(),
                Forms\Components\Select::make('perusahaan_id')
                    ->label('Perusahaan')
                    ->relationship(
                        name: 'perusahaan',
                        titleAttribute: 'nama',
                    )
                    ->searchable()
                    ->required()
                    ->validationMessages([
                        'required' => '*Perusahaan Wajib di Pilih',
                    ])
                    ->preload()
                    ->native(false)
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_aktif')
                    ->label('Aktif')
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kontak.nama_depan')
                    ->label('Kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('perusahaan.nama')
                    ->label('Perusahaan')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_aktif')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageKontakPerusahaan::route('/'),
        ];
    }
}
