<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\Pergunta;
use App\Models\Submissao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AvaliacaoController extends Controller
{
    /**
     * Mostra o formulário de avaliação para um dispositivo específico.
     * * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|string
     */
    public function index(Request $request)
    {
        if (!$request->has('dispositivo_id')) {
            return 'Erro: Dispositivo não identificado. Acesse usando a URL ?dispositivo_id=SEU_ID';
        }

        try {
            $dispositivo = Dispositivo::where('status', 'ativo')
                ->findOrFail($request->query('dispositivo_id'));

            $perguntas = Pergunta::where(
                    [
                        'status'   => 1,
                        'setor_id' => $dispositivo->setor_id
                    ]
                )
                ->orderBy('ordem', 'asc')
                ->get();


            if ($perguntas->isEmpty()) {
                return 'Nenhuma pergunta cadastrada ou ativa no momento.';
            }

            return view('avaliacao.index', compact('dispositivo', 'perguntas'));
        } 
        catch (\Exception $e) {
            Log::error('Falha ao carregar dispositivo: ' . $e->getMessage());
            return 'Erro: Dispositivo não encontrado ou inativo.';
        }
    }

    /**
     * Salva a submissão da avaliação no banco de dados.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dispositivo_id'   => 'required|exists:dispositivos,id',
            'feedback_textual' => 'nullable|string|max:5000',
            'respostas'        => 'required|array',
            'respostas.*'      => 'required|integer|min:0|max:10',
        ]);

        try {
            DB::transaction(function () use ($validated) {

                $submissao = Submissao::create([
                    'dispositivo_id' => $validated['dispositivo_id'],
                    'feedback_textual' => $validated['feedback_textual'],
                ]);

                foreach ($validated['respostas'] as $pergunta_id => $pontuacao) {
                    $submissao->respostas()->create([
                        'pergunta_id' => $pergunta_id,
                        'pontuacao' => $pontuacao,
                    ]);
                }
            });

            return redirect()->route('avaliacao.obrigado', ['dispositivo_id' => $validated['dispositivo_id']]);
        } 
        catch (\Exception $e) {
            Log::error('Erro ao salvar avaliação: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Ocorreu um erro ao salvar sua avaliação. Tente novamente.')
                ->withInput();
        }
    }
}
