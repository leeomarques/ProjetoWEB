<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!--  <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
    <link rel="stylesheet" href="{{URL::to('css/app.css')}}">

    <title>Produtos</title>
</head>
<body>

    @if(isset($produtos))

        @if(count($produtos) == 0)
        <h1>Nenhum Produto</h1>
        @elseif(count($produtos) === 1)
        <h1>Temos 1 Produto</h1>
        @else
        <h1>Temos Vários Produtos</h1>

        @foreach($produtos as $p)
            <p>Descrição: {{$p}}</p>
        @endforeach

        @endif
    @else
        <h2>Variável não foi passado como parametro.</h2>
    @endif

    @empty($produtos)
    <h2>Nada em produtos</h2>
    @endempty



<!--<script src="{{asset('js/app.js')}}" type="text/javascript"></script> -->
<script src="{{URL::to('js/app.js')}}" type="text/javascript"></script>
    
</body>
</html>