<?php
namespace App\Filament\Widgets;

use App\Models\Submissao;
use App\Models\Resposta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AvaliacaoStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Avaliações', Submissao::count())
                ->description('Total de formulários respondidos')
                ->icon('heroicon-o-document-chart-bar'),
            Stat::make('Média Geral de Notas', number_format(Resposta::avg('pontuacao'), 2))
                ->description('Média de todas as perguntas')
                ->icon('heroicon-o-star'),
            Stat::make('Avaliações Hoje', Submissao::whereDate('created_at', today())->count())
                ->description('Formulários respondidos hoje')
                ->icon('heroicon-o-calendar-days'),
        ];
    }
}