<?php

namespace App\Filament\Resources\Data\GrupResource\Pages;

use App\Filament\Resources\Data\GrupResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGrup extends ManageRecords
{
    protected static string $resource = GrupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
