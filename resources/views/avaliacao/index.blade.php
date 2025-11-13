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

<form action="{{ route('avaliacao.store') }}" method="POST">
   @csrf
   <input type="hidden" name="dispositivo_id" value="{{ $dispositivo->id }}">

   @foreach ($perguntas as $pergunta)
   <div class="pergunta-item"> <p class="pergunta-texto">{{ $loop->iteration }}. {{ $pergunta->texto_pergunta }}</p>
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
      <div class="escala-labels">
         <span>Improvável</span>
         <span>Muito Provável</span>
      </div>
   </div> 
   @endforeach 
   
   <div class="pergunta-item">
      <label for="feedback_textual" class="pergunta-texto">Deixe seu feedback (opcional):</label>
      <textarea name="feedback_textual" id="feedback_textual" placeholder="Gostaria de adicionar um comentário..."></textarea>
   </div>

   <div style="text-align: center; padding-top: 1rem;">
      <button type="submit">Enviar Avaliação</button>
   </div>
</form>

<footer>
   <p>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</p>
</footer>

@endsection

