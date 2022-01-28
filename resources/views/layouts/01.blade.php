@extends('layouts.main') <?php // Funciona como o include_once ?>

@section('title', 'HCD Events') <?php // Define o título da página ?>

@section('content') <?php // Copia o conteúdo selecionado do arquivo ?>

<h1>Olá Mundinho</h1>
        <img src="img/banner.png" alt="Banner">
       @if(10 > 5)
       <p>A condição é true</p>
       @endif

      <p> {{ $nome }} </p>

      @if($nome == "malvadinha")
        <p>bbzinha num é malvadinha</p>
      @elseif($nome == "bbzinha")
        <p>bbzinha é boazinha e ela vai fazer {{$idade}} anos e é {{$profissao}}</p>
        @else
        <p>Num é a minha bbzinha :c </p>
      @endif


      @for($i=0; $i < count($arr); $i++)
            <p>{{ $arr[$i] }}</p>
            @if($i == 2)
                o i é 2 daaaaa
                @endif
      @endfor

    @foreach($names as $nome)
            <p> {{ $nome }} </p>
            <p> {{$loop->index}} </p>  <?php // comando para acessar o índice do foreach ?>
    @endforeach

      @php  // Para escrever em php puro
        $name = "teste";
        echo $name;
      @endphp

      <?php // ^^^^ isso é inútil pois posso abrir o php assim... ?>


      {{-- Este é o comentário do blade, não é renderizado pela view do html --}}

      @endsection