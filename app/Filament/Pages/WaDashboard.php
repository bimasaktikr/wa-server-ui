<?php

namespace App\Filament\Pages;

use App\Models\Waserver;
use Filament\Actions\Action;
use Filament\Actions\Concerns\HasAction;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;

class WaDashboard extends Page
{
     use HasAction;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'WA Dashboard';
    protected static ?string $title = 'WhatsApp Dashboard';
    protected static string $view = 'filament.pages.wa-dashboard';

    public $waStatus = [];
    public $qrCode = null;

    public function mount(): void
    {
        $this->refreshStatus();
    }

    public function getTitle(): string
    {
        return 'WhatsApp Dashboard';
    }

    public function refreshStatus(): void
    {
        $server = \App\Models\WaServer::latest()->first();

        $statusUrl = $server->host . '/status';
        $qrUrl = rtrim($server->host) . '/qr';

        $headers = ['x-api-key' => $server->apikey];

        $statusRes = Http::withHeaders($headers)->get($statusUrl);
        $this->waStatus = $statusRes->successful() ? $statusRes->json() : [];

        if (($this->waStatus['status'] ?? null) === 'SCAN_QR') {
            $qrRes = Http::withHeaders($headers)->get($qrUrl);
            $this->qrCode = $qrRes->successful() ? $qrRes->json('qr') : null;
        }
    }
}
