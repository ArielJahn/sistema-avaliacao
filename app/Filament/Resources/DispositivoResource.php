<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DispositivoResource\Pages;
use App\Models\Dispositivo;
use Exception;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class DispositivoResource extends Resource
{
    protected static ?string $model = Dispositivo::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-tablet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->required()
                    ->maxLength(255),
                Select::make('setor_id')
                    ->relationship('setor', 'nome')
                    ->label('Setor')
                    ->required(),
                Select::make('status')
                    ->options([
                        'ativo' => 'Ativo',
                        'inativo' => 'Inativo',
                    ])
                    ->required()
                    ->default('ativo'),
            ]);
    }

    /**
     * @throws Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')->searchable()->sortable(),
                TextColumn::make('setor.nome')->label('Setor')->sortable(),
                IconColumn::make('status')
                    ->icon(fn (string $state): string => match ($state) {
                        'ativo' => 'heroicon-o-check-circle',
                        'inativo' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'ativo' => 'success',
                        'inativo' => 'danger',
                    })
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('setor')
                    ->relationship('setor', 'nome'),
                SelectFilter::make('status')
                    ->options([
                        'ativo' => 'Ativo',
                        'inativo' => 'Inativo',
                    ]),
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
            'index' => Pages\ListDispositivos::route('/'),
            'create' => Pages\CreateDispositivo::route('/create'),
            'edit' => Pages\EditDispositivo::route('/{record}/edit'),
        ];
    }
}
