<?php

namespace App\Filament\Pages;

// use Filament\Actions\Action;
// actoin
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Actions\Action as FormAction;


class SendMessage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static string $view = 'filament.pages.send-message';
    protected static ?string $navigationLabel = 'Kirim Pesan';
    protected static ?string $title = 'Kirim Pesan WhatsApp';

    public $number;
    public $message;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')
                            ->label('Nomor Tujuan (628xxxx)')
                            ->required(),

                TextInput::make('message')
                    ->label('pesan')
                    ->required(),
                Actions::make([
                    FormAction::make('send')
                        ->label('Load Data')
                        ->action('send')
                        ->icon('heroicon-o-arrow-path')
                        ->color('primary')
                ])->alignEnd()->fullWidth(),
            ]);
    }

    public function send()
    {
        $response = Http::post('http://localhost:3000/send-message', [
            'number' => $this->number,
            'message' => $this->message,
        ]);

        if ($response->successful()) {
            Notification::make()
                ->title('Pesan berhasil dikirim!')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Gagal mengirim pesan.')
                ->body($response->json('error') ?? 'Terjadi kesalahan.')
                ->danger()
                ->send();
        }
    }


}
