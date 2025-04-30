<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WaserverResource\Pages;
use App\Filament\Resources\WaserverResource\RelationManagers;
use App\Models\Waserver;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaserverResource extends Resource
{
    protected static ?string $model = Waserver::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('host')
                    ->label('Host Name')
                    ->required(),
                TextInput::make('apikey')
                    ->label('APIKEY')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('host')
                    ->label('Host Name  ')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('apikey')
                    ->label('API KEY')
                    ->sortable()
                    ->searchable(),
                ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
   Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWaservers::route('/'),
            'create' => Pages\CreateWaserver::route('/create'),
            'edit' => Pages\EditWaserver::route('/{record}/edit'),
        ];
    }
}
