@extends('layouts.questionario')

@section('content')
<div class="agradecimento">
   <h2>Obrigado!</h2>
   <p>
      O Estabelecimento agradece sua resposta e ela é muito importante para nós, pois nos ajuda a melhorar continuamente nossos serviços.
   </p>
</div>

<script src="{{ asset('js/obrigado.js') }}" defer></script>

@endsection