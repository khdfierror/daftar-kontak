<?php

namespace App\Filament\Resources\Data;

use App\Filament\Resources\Data\KontakResource\Pages;
use App\Filament\Resources\Data\KontakResource\RelationManagers;
use App\Models\Data\Kontak;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Foundation\Exceptions\Renderer\Frame;

class KontakResource extends Resource
{
    protected static ?string $model = Kontak::class;

    protected static ?string $navigationIcon = null;

    protected static ?string $navigationLabel = 'Kontak';

    protected static ?string $pluralLabel = 'Kontak';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_depan')
                    ->label('Nama Depan')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nama_belakang')
                    ->label('Nama Belakang')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->unique()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('phone')
                    ->label('No Telp')
                    ->unique()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('alamat')
                    ->label('Alamat')
                    ->autosize()
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Toggle::make('is_aktif')
                    ->label('Aktif')
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_depan')
                    ->label('Nama Depan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_belakang')
                    ->label('Nama Belakang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('No Telp'),
                Tables\Columns\ToggleColumn::make('is_aktif')
                    ->label('Aktif'),
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
            'index' => Pages\ManageKontak::route('/'),
        ];
    }
}
