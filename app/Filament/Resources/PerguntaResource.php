<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Pergunta;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\PerguntaResource\Pages;

class PerguntaResource extends Resource
{
    protected static ?string $model = Pergunta::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('setor_id')
                    ->relationship('setor', 'nome')
                    ->label('Setor')
                    ->required()
                    ->searchable()
                    ->preload(),
                Textarea::make('texto_pergunta')
                    ->label('Texto da Pergunta')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check')
                    ->offIcon('heroicon-o-x-mark')
                    ->inline(false)
                    ->default(true)
                    ->label('Status')
                    ->helperText('Perguntas inativas não aparecem no formulário.'),
                TextInput::make('ordem')
                    ->numeric()
                    ->default(0)
                    ->label('Ordem')
                    ->helperText('Define a ordem de exibição das perguntas (0 primeiro).'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('setor.nome')
                    ->label('Setor')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('texto_pergunta')
                    ->label('Texto da Pergunta')
                    ->limit(60)
                    ->wrap(),
                IconColumn::make('status')
                    ->icon(fn (string $state): string => match ($state) {
                        'ativa' => 'heroicon-o-check-circle',
                        'inativa' => 'heroicon-o-x-circle',
                        default => 'heroicon-o-question-mark-circle'
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'ativa' => 'success',
                        'inativa' => 'danger',
                        default => 'gray'
                    })
                    ->label('Status'),
                TextColumn::make('ordem')->sortable()->label('Ordem'),
            ])
            ->filters([
                SelectFilter::make('setor')
                    ->relationship('setor', 'nome')
                    ->label('Filtrar por Setor'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('ordem', 'asc')
            ->reorderable('ordem');
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
            'index'  => Pages\ListPerguntas::route('/'),
            'create' => Pages\CreatePergunta::route('/create'),
            'edit'   => Pages\EditPergunta::route('/{record}/edit'),
        ];
    }


}
