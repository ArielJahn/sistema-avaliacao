<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissaoResource\Pages;
use App\Models\Submissao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;

class SubmissaoResource extends Resource
{
    protected static ?string $model = Submissao::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Respostas';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Submissao|\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('dispositivo.nome')->label('Dispositivo')->sortable(),
                TextColumn::make('dispositivo.setor.nome')->label('Setor')->sortable(),
                TextColumn::make('feedback_textual')
                    ->label('Feedback')
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('dispositivo')
                    ->relationship('dispositivo', 'nome'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // Ação de Visualizar
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListSubmissaos::route('/'),
            'view' => Pages\ViewSubmissao::route('/{record}'),
        ];
    }
}
