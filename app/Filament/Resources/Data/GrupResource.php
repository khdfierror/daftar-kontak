<?php

namespace App\Filament\Resources\Data;

use App\Filament\Resources\Data\GrupResource\Pages;
use App\Filament\Resources\Data\GrupResource\RelationManagers;
use App\Models\Data\Grup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GrupResource extends Resource
{
    protected static ?string $model = Grup::class;

    protected static ?string $navigationIcon = null;

    protected static ?string $navigationLabel = 'Grup';

    protected static ?string $pluralLabel = 'Grup';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Grup')
                    ->required()
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
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Grup')
                    ->searchable(),
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
            'index' => Pages\ManageGrup::route('/'),
        ];
    }
}
