<?php

namespace App\Filament\Resources\Data;

use App\Filament\Resources\Data\AgendaResource\Pages;
use App\Filament\Resources\Data\AgendaResource\RelationManagers;
use App\Models\Data\Agenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = null;

    protected static ?string $navigationLabel = 'Agenda';

    protected static ?string $pluralLabel = 'Agenda';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 3;

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
                Forms\Components\TextInput::make('nama')
                    ->label('Nama')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->native(false)
                    ->format('Y-m-d')
                    ->displayFormat('d/m/Y')
                    ->required()
                    ->columnSpanFull()
                    ->suffixIcon('carbon-event-schedule'),
                Forms\Components\TimePicker::make('waktu')
                    ->label('Waktu')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('lokasi')
                    ->label('Lokasi')
                    ->autosize()
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kontak.nama_depan')
                    ->label('Kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Agenda')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->formatStateUsing(function (Model $record) {
                        $tanggal = $record->tanggal?->locale('id')->translatedFormat('l, d M Y');

                        return new HtmlString(<<<HTML
                        <div class="text-center">
                            <div>$tanggal</div>
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
            'index' => Pages\ManageAgendas::route('/'),
        ];
    }
}
