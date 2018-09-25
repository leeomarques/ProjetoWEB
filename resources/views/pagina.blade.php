<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!--  <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
    <link rel="stylesheet" href="{{URL::to('css/app.css')}}">

    <title>Página</title>
</head>
<body>

    @alerta(['tipo'=>'danger', 'titulo'=>'Erro Fatal'])
    <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'warning', 'titulo'=>'Erro Fatal'])
    <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta

    @alerta(['tipo'=>'success', 'titulo'=>'Erro Fatal'])
    <strong>Erro: </strong> Sua mensagem de erro.
    @endalerta


<!--<script src="{{asset('js/app.js')}}" type="text/javascript"></script> -->
<script src="{{URL::to('js/app.js')}}" type="text/javascript"></script>
    
</body>
</html>