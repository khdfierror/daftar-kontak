<?php

namespace App\Filament\Resources\CatatanResource\Pages;

use App\Filament\Resources\CatatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCatatan extends ManageRecords
{
    protected static string $resource = CatatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
