<?php

namespace App\Filament\Resources\KontakPerusahaanResource\Pages;

use App\Filament\Resources\KontakPerusahaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageKontakPerusahaan extends ManageRecords
{
    protected static string $resource = KontakPerusahaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
