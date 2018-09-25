<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Lista de Todos os Clientes - Raiz';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'Formulario de Cadastro de Cliente';
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $s = "Armazenar: ";
        $s .= "Nome " . $request->input('nome') . " e ";
        $s .= "Idade " . $request->input('idade');
        return response($s,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $v = ['Leonardo', 'Marques', 'Guilherme', 'Marques'];
        
        if ($id >= 0 && $id < count($v)) {
            return $v[$id];
        }else{
            return 'Não Encontrado';
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'Formulario para Editar Cliente com ID ' . $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $s = "Atualizar Cliente com id $id: ";
        $s .= "Nome " . $request->input('nome') . " e ";
        $s .= "Idade " . $request->input('idade');
        return response($s,200);

        //incluir no postman mais esse parametro _method PUT
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response("Apagado Cliente com id $id", 200 );
    }

    public function requisitar(Request $request){
        echo "nome: " . $request->input('nome');
    }
}
