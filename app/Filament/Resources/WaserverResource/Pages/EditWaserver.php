<?php

namespace App\Filament\Resources\WaserverResource\Pages;

use App\Filament\Resources\WaserverResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaserver extends EditRecord
{
    protected static string $resource = WaserverResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
