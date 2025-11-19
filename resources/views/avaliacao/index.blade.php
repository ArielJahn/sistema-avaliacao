@extends('layouts.questionario')

@section('content')
<header style="text-align: center; margin-bottom: 2rem;">
   <h1>Avalie nosso Atendimento</h1>
   <p>Setor: <strong>{{ $dispositivo->setor->nome }}</strong> (Dispositivo: {{ $dispositivo->nome }})</p>
</header>

@if (session('error'))
<div style="color: red; text-align: center; margin-bottom: 1rem;">
   {{ session('error') }}
</div>
@endif

<form id="questionario-form" action="{{ route('avaliacao.store') }}" method="POST">
   @csrf
   <input type="hidden" name="dispositivo_id" value="{{ $dispositivo->id }}">

   @foreach ($perguntas as $pergunta)
   <div class="pergunta-item etapa">
      <p class="pergunta-texto">{{ $loop->iteration }}. {{ $pergunta->texto_pergunta }}</p>
      <div class="escala-container">
         @for ($i = 0; $i <= 10; $i++)
         <div class="escala-item">
            <input type="radio"
               name="respostas[{{ $pergunta->id }}]"
               id="p{{ $pergunta->id }}-n{{ $i }}"
               value="{{ $i }}"
               required>
            <label for="p{{ $pergunta->id }}-n{{ $i }}" style="--note-color: @colorForNote($i);">
               {{ $i }}
            </label>
         </div>
         @endfor
      </div>

      <div class="navegacao-botoes">
         <button type="button" class="btn-voltar">Voltar</button>
         <button type="button" class="btn-proximo">Próximo</button>
      </div>
   </div>
   @endforeach

   <div class="pergunta-item etapa">
      <label for="feedback_textual" class="pergunta-texto">Deixe seu feedback (opcional):</label>
      <textarea name="feedback_textual" id="feedback_textual" placeholder="Gostaria de adicionar um comentário..."></textarea>
      
      <div class="navegacao-botoes">
         <button type="button" class="btn-voltar">Voltar</button>
         <button type="submit" class="btn-enviar">Enviar Avaliação</button>
      </div>
   </div>

</form>

<footer>
   <p>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
</footer>

<div id="modal-alerta" class="modal-overlay">
   <div class="modal-conteudo">
      <span class="modal-fechar">&times;</span>
      <p id="modal-mensagem"></p>
      <button type="button" class="btn-modal-ok">OK</button>
   </div>
</div>

@endsection