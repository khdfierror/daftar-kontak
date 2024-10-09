<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasResource\Pages;
use App\Filament\Resources\TugasResource\RelationManagers;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;

    protected static ?string $navigationIcon = 'carbon-task';

    protected static ?string $navigationLabel = 'Tugas';

    protected static ?string $pluralLabel = 'Tugas';

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
                Forms\Components\TextInput::make('judul')
                    ->label('Judul')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->autosize()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tenggat')
                    ->label('Tenggat')
                    ->native(false)
                    ->format('Y-m-d')
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->columnSpanFull()
                    ->suffixIcon('carbon-event-schedule'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kontak.nama_depan')
                    ->label('Kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->tooltip(function (TextColumn $column):?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    })
                    ->limit(50),
                    Tables\Columns\TextColumn::make('tenggat')
                    ->label('Tenggat')
                    ->formatStateUsing(function (Model $record) {
                        $tenggat = $record->tenggat?->locale('id')->translatedFormat('l, d M Y');

                        return new HtmlString(<<<HTML
                        <div class="text-center">
                            <div>$tenggat</div>
                        </div>
                    HTML);
                    })
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
            'index' => Pages\ManageTugas::route('/'),
        ];
    }
}
