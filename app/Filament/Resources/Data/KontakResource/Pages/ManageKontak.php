<?php

namespace App\Filament\Resources\Data\KontakResource\Pages;

use App\Filament\Resources\Data\KontakResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKontak extends ManageRecords
{
    protected static string $resource = KontakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
