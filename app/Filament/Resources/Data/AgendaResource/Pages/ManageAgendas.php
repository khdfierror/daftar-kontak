<?php

namespace App\Filament\Resources\Data\AgendaResource\Pages;

use App\Filament\Resources\Data\AgendaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAgendas extends ManageRecords
{
    protected static string $resource = AgendaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
