@extends('layout.app')

@section('titulo', 'Minha Pagina - Filho')

@section('barralateral')
    @parent
    <p>Essa Parte é do FILHO</p>
@endsection

@section('conteudo')
    <p>Este é o conteudo do Filho</p>
@endsection

