<x-filament::page>
    {{-- @if ($qrCode)
        <x-filament::modal id="qr-modal" :visible="true">
            <x-slot name="header">Scan QR</x-slot>
            <x-slot name="content">
                <div class="flex items-center justify-center p-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode($qrCode) }}" alt="QR Code">
                </div>
            </x-slot>
        </x-filament::modal>
    @endif --}}


    <div class="space-y-4">
        <x-filament::card>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold">Status WhatsApp</h2>

                    @php
                        $status = $waStatus['status'] ?? 'UNKNOWN';
                        $client = $waStatus['clientInfo'];
                        $color = match($status) {
                            'CONNECTED' => 'text-green-600',
                            'SCAN_QR' => 'text-yellow-500',
                            'DISCONNECTED' => 'text-red-600',
                            default => 'text-gray-500'
                        };
                    @endphp

                    <p class="mt-2 {{ $color }}">
                        Status: {{ $status }}
                    </p>

                    @if ($client)
                        <p class="mt-1 text-gray-700">
                            Nama: {{ $client['name'] }}<br>
                            Nomor: {{ $client['number'] }}
                        </p>
                    @endif
                </div>

                @if ($status === 'SCAN_QR' && $qrCode)
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Silakan Scan QR</h3>
                        <img
                            src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode($qrCode) }}&size=200x200"
                            alt="QR Code"
                            class="mt-2 border rounded"
                        >
                    </div>
                @endif

                <form wire:submit.prevent="refreshStatus">
                    <x-filament::button type="submit">
                        🔄 Refresh
                    </x-filament::button>
                </form>
            </div>
        </x-filament::card>
    </div>
</x-filament::page>
