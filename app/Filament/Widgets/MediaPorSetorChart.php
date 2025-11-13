<?php
namespace App\Filament\Widgets;

use App\Models\Setor;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MediaPorSetorChart extends ChartWidget
{
    protected static ?string $heading = 'Média de Pontuação por Setor';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $dados = Setor::with('dispositivos.submissoes.respostas')
            ->get()
            ->map(function ($setor) {
                $pontuacoes = $setor->dispositivos->flatMap(function ($dispositivo) {
                    return $dispositivo->submissoes->flatMap(function ($submissao) {
                        return $submissao->respostas->pluck('pontuacao');
                    });
                });

                return [
                    'setor' => $setor->nome,
                    'media' => $pontuacoes->count() > 0 ? $pontuacoes->avg() : 0,
                ];
            });

        return [
            'datasets' => [
                [
                    'label' => 'Média de Pontuação',
                    'data' => $dados->pluck('media')->toArray(),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
            ],
            'labels' => $dados->pluck('setor')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Gráfico de barras
    }
}