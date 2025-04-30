<?php

namespace App\Filament\Resources\WaserverResource\Pages;

use App\Filament\Resources\WaserverResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWaserver extends CreateRecord
{
    protected static string $resource = WaserverResource::class;
    protected static bool $canCreateAnother = false;

    //customize redirect after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
