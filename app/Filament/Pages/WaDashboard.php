<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;

class WaDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'WA Dashboard';
    protected static ?string $title = 'WhatsApp Dashboard';
    protected static string $view = 'filament.pages.wa-dashboard';

    public $waStatus = [];

    public function mount(): void
    {
        $this->refreshStatus();
    }

    public function refreshStatus(): void
    {
        $response = Http::get('http://localhost:3000/status');
        $this->waStatus = $response->successful()
            ? $response->json()
            : [
                'status' => 'DISCONNECTED',
                'clientInfo' => null,
            ];
    }
}
