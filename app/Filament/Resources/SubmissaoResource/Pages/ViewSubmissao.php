<?php

namespace App\Filament\Resources\SubmissaoResource\Pages;

use App\Filament\Resources\SubmissaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;

class ViewSubmissao extends ViewRecord
{
    protected static string $resource = SubmissaoResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detalhes da Submissão')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('dispositivo.nome')->label('Dispositivo'),
                        TextEntry::make('dispositivo.setor.nome')->label('Setor'),
                        TextEntry::make('created_at')->label('Data/Hora')->dateTime('d/m/Y H:i:s'),
                        TextEntry::make('feedback_textual')
                            ->label('Feedback Textual')
                            ->columnSpanFull()
                            ->placeholder('Nenhum feedback fornecido.'),
                    ]),
                Section::make('Respostas')
                    ->schema([
                        RepeatableEntry::make('respostas')
                            ->label('')
                            ->schema([
                                TextEntry::make('pergunta.texto_pergunta')
                                    ->label('Pergunta')
                                    ->columnSpan(2), // Pergunta ocupa mais espaço
                                TextEntry::make('pontuacao')
                                    ->label('Nota')
                                    ->badge()
                                    ->color(fn (int $state): string => match (true) {
                                        $state <= 3 => 'danger',
                                        $state <= 6 => 'warning',
                                        $state <= 8 => 'success',
                                        default => 'primary',
                                    }),
                            ])
                            ->columns(3),
                    ]),
            ]);
    }
}
