<?php

namespace App\Filament\Resources\WaserverResource\Pages;

use App\Filament\Resources\WaserverResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaservers extends ListRecords
{
    protected static string $resource = WaserverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
