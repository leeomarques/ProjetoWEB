<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuControlador extends Controller
{
    public function getNome(){
        return 'Joao Leonardo';
    }

    public function getIdade(){
        return '20 Anos';
    }

    public function multiplicar($n1,$n2){
        return $n1 * $n2;
    }

    public function getNomeByID($id){
        $v = ['Mario', 'Edson', 'Leonardo', 'Guilherme'];
        
        if ($id >= 0 && $id < count($v)) {
            return $v[$id];
        }else{
            return 'Não Encontrado';
        }

    }
}
