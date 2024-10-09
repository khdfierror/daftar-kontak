<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatatanResource\Pages;
use App\Filament\Resources\CatatanResource\RelationManagers;
use App\Models\Catatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CatatanResource extends Resource
{
    protected static ?string $model = Catatan::class;

    protected static ?string $navigationIcon = 'carbon-catalog';

    protected static ?string $navigationLabel = 'Catatan';

    protected static ?string $pluralLabel = 'Catatan';

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
                Forms\Components\MarkdownEditor::make('catatan')
                    ->label('Catatan')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kontak.nama_depan')
                    ->label('Kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('catatan')
                    ->label('Catatan')
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    })
                    ->limit(50),
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
            'index' => Pages\ManageCatatan::route('/'),
        ];
    }
}
