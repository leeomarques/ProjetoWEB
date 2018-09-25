<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Categoria;

Route::get('/', function () {
    return view('pagina');
});

//Routes

Route::get('/usuarios', 'UsuariosController@index');

Route::get('/repetir/{nome}/{n}', function ($nome, $n) {
        for ($i=0; $i < $n ; $i++) {
            echo "<h1>Ola, $nome !</h1>";
    }
});

Route::get('/seunomecomregra/{nome}/{n}', function($nome, $n){
    for ($i=0; $i < $n ; $i++) {
        echo "<h1>Ola, $nome ! ($i) </h1>";
}
})->where('n', '[0-9]+')->where('nome', '[A-Za-z]+');

Route::get('/seunomesemregra/{nome?}', function($nome=null){
    if (isset($nome)) {
        echo "<h1>Ola, $nome ! </h1>";
    }else{
        echo "Você não passou nenhum nome :/";
    }

});

// Controller
Route::prefix('app')->group(function(){

    Route::get('/', function(){
        echo 'Pagina Principal APP';
    });
    Route::get('profile', function(){
        echo 'Pagina Profile';
    });
    Route::get('about', function(){
        echo 'Pagina About';
    });

});

Route::redirect('/aqui', '/usuarios',301);

//Route::get('/hello', function () {
//    return view('hello');
//});

Route::view('/hello', 'hello');

Route::get('/rest/hello', function(){
    return 'Hello (GET)';
});

Route::post('/rest/hello', function(){
    return 'Hello (POST)';
});

Route::delete('/rest/hello', function(){
    return 'Hello (DELETE)';
});

Route::put('/rest/hello', function(){
    return 'Hello (PUT)';
});

Route::patch('/rest/hello', function(){
    return 'Hello (PATCH)';
});

Route::options('/rest/hello', function(){
    return 'Hello (OPTIONS)';
});

Route::post('/rest/imprimir', function(Request $req){
    $nome = $req->input('nome');
    $idade = $req->input('idade');
    return "Hello $nome ($idade)!! (POST)";
});

Route::match(['get','post'], '/rest/hello2', function(){
    return 'Hello 2';
});


Route::any('/rest/hello3', function(){
    return 'Hello 3';
});

Route::get('/produtos', function(){
    echo "<h1>Produtos</h1>";
    echo "<ol>";
    echo "<li>Notebooks</li>";
    echo "<li>Impressora</li>";
    echo "<li>Mouse</li>";
    echo "</ol>";

})->name('MeusProdutos');

Route::get('/linkprodutos', function(){
    $url = route('MeusProdutos');
    echo "<a href='".$url."'> Meus Produtos</a>";
});

Route::get('/redirecionarprodutos', function(){
    return redirect()->route('MeusProdutos');
});


Route::get('/nome', 'MeuControlador@getNome');

Route::get('/idade', 'MeuControlador@getIdade');

Route::get('/multiplicar/{n1}/{n2}', 'MeuControlador@multiplicar');

Route::get('/nomes/{id}', 'MeuControlador@getNomeByID');

Route::resource('/cliente', 'ClienteControlador');

Route::post('/cliente/requisitar', 'ClienteControlador@requisitar');

// View
Route::get('/primeiraview', function(){
    return view('minhaview');
});

Route::get('/ola', function(){
    return view('minhaview')
    ->with('nome', 'Leonardo')
    ->with('sobrenome', 'Marques');
});

Route::get('/ola/{nome}/{sobrenome}', function($nome, $sobrenome){
    /*
    return view('minhaview')
    ->with('nome', $nome)
    ->with('sobrenome', $sobrenome);
    */

    /*
    //=> (significa) Corresponder
    $parametros = ['nome'=>$nome, 'sobrenome'=>$sobrenome];
    return view('minhaview' , $parametros);
    */

    //Modo mais fácil usando o compact
    return view('minhaview', compact('nome','sobrenome'));

});

//verificando se existe a view antes de acessar
Route::get('/email/{email}', function($email){
        if (View::exists('email'))//Saber se existe a view
            return view('email', compact('email'));
        else
            return view('erro');
    });

//Aula de Views
Route::get('/produtos', 'ProdutoControlador@listar');

Route::get('/secaoprodutos/{palavra}',
           'ProdutoControlador@secaoprodutos');

//Switch Case Views
Route::get('/mostraropcoes', 'ProdutoControlador@mostrar_opcoes');

Route::get('/opcoes/{opcao}', "ProdutoControlador@opcoes");

//Laços de Repetição
Route::get('/loop/for/{n}', "ProdutoControlador@loopFor");

//Loop Foreach Arrays Associativos
Route::get('/loop/foreach', "ProdutoControlador@loopForeach");

//SQL Querys

//listar dados
Route::get('/categorias', function(){
    $cats = DB::table('categorias')->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }
    echo "<hr>";

    $nomes = DB::table('categorias')->pluck('nome');
    foreach ($nomes as $nome) {
        echo "$nome <br>";
    }
    echo "<hr>";

    $cats = DB::table('categorias')->where('id',1)->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }
    echo "<hr>";

    $cat = DB::table('categorias')->where('id',1)->first();
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";

    echo "<p> <h1>Retorna um array utilizando like</h1></p>";

    $cats = DB::table('categorias')->where('nome', 'like', '%p%')->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }
    echo "<hr>";

    echo "<p> <h1>Criando Sentenças lógicas</h1></p>";

    $cats = DB::table('categorias')->where('id', 1)->orWhere('id', 2)->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<p> <h1>intervalos</h1></p>";

    $cats = DB::table('categorias')->whereBetween('id', [1,4])->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }


    echo "<hr>";



    $cats = DB::table('categorias')->whereNotBetween('id', [1,2])->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<hr>";

    $cats = DB::table('categorias')->whereIn('id', [1,2,4])->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<hr>";

    $cats = DB::table('categorias')->whereNotIn('id', [1,2,4])->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<hr>";

    echo "<p> <h1> Sentenças lógicas</h1></p>";

    $cats = DB::table('categorias')->where([
        ['id',1],
        ['nome' , 'roupas']
    ])->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

    echo "<hr>";

    echo "<p> <h1> Ordenando por Nome</h1></p>";

    $cats = DB::table('categorias')->orderBy('nome')->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";

    }



    echo "<hr>";

    echo "<p> <h1> Ordenando por Nome decrescente</h1></p>";

    $cats = DB::table('categorias')->orderBy('nome', 'desc')->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

});
//incluir dados
Route::get('/novascategorias', function(){
    $id = DB::table('categorias')->insertGetId(['nome' => 'Carros']);
    echo "Novo ID = $id <br>";
});
//Alterar dados
Route::get('/atualizandocategorias', function(){

    $cat = DB::table('categorias')->where('id', 10)->first();
    echo "<p> Antes da atualização </p>";
    echo "id: " .$cat->id . "; ";
    echo "nome: " . $cat->nome . "<br>";

    echo "<hr>";

    DB::table('categorias')->where('id', 10)
        ->update(['nome' => 'Roupas infantis']);
    $cat = DB::table('categorias')->where('id', 10)->first();
    echo "<p> Depois da atualização </p>";
    echo "id: " .$cat->id . "; ";
    echo "nome: " . $cat->nome . "<br>";

});
//Apagar dados
Route::get('/apagandocategorias', function(){

    echo "<p> Antes da remoção </p>";


    $cats = DB::table('categorias')->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }
    echo "<hr>";

    //DB::table('categorias')->where('id', 11)->delete();
    DB::table('categorias')->whereNotIn('id',[1,2,3,4,5,6])->delete();

    echo "<p> Depois da remoção </p>";

    $cats = DB::table('categorias')->get();
    foreach ($cats as $cat) {
        echo "id: " . $cat->id . "; ";
        echo "nome: " . $cat->nome . "<br> ";
    }

});

//Eloquent / ORM

//Listar (GET) Categoria *

Route::get('/listcat', function () {
    $categorias = Categoria::all();
    foreach ($categorias as $c) {
        echo "id: " . $c->id . ', ';
        echo "nome: " . $c->nome . "<br>";
    }
});


//Inserir Categoria
Route::get('/inserir/{nome}', function ($nome) {
    $cat = new Categoria();
    $cat->nome = $nome;
    $cat->save();
    return redirect('/listcat');
});

//recuperar por id
Route::get('/categoria/{id}', function ($id) {
    $cat = Categoria::find($id);
   // ou usar o findorfail que retorna a pagina com erro 404
    if (isset($cat)) {
        echo "id: " . $cat->id . ', ';
        echo "nome: " . $cat->nome . "<br>";
    }else{
        echo "<h1>Categoria não Encontrada</h1>";
    }

});

//atualizar Categoria

Route::get('/atualizar/{id}/{nome}', function ($id, $nome) {
    $cat = Categoria::find($id);
   // ou usar o findorfail que retorna a pagina com erro 404
    if (isset($cat)) {
        $cat->nome = $nome;
        $cat->save();
        return redirect('/listcat');

    }else{
        echo "<h1>Categoria não Encontrada</h1>";
    }

});

//Remover Categoria
Route::get('/remover/{id}', function ($id) {
    $cat = Categoria::find($id);
   // ou usar o findorfail que retorna a pagina com erro 404
    if (isset($cat)) {
        $cat->delete();
        return redirect('/listcat');

    }else{
        echo "<h1>Categoria não Encontrada</h1>";
    }

});

//procurar Categoria Utilizando 'where' por nome
Route::get('/categoriapornome/{nome}', function ($nome) {
    $categorias = Categoria::where('nome', $nome)->get();
    foreach ($categorias as $c) {
        echo "id: " . $c->id . ', ';
        echo "nome: " . $c->nome . "<br>";
    }
});

//procurar Categoria Utilizando 'where' por id ((Maior ou numero igual que estou passando))
Route::get('/categoriaidmaiorque/{id}', function ($id) {
    $categorias = Categoria::where('id','>=',$id)->get();
    foreach ($categorias as $c) {
        echo "id: " . $c->id . ', ';
        echo "nome: " . $c->nome . "<br>";
    }

    //Contador (Count)
    $count = Categoria::where('id',">=",$id)->count();
    echo "<h1>Count: $count</h1>";
    //Numero Máximo (Count)
    $max = Categoria::where('id',">=",$id)->max('id');
    echo "<h1>Count: $max</h1>";

});

//procurar Categoria Utilizando 'where' por id 1 2 e 3 todos os ids
Route::get('/ids123', function () {
    $categorias = Categoria::find([1,2,3]);
    foreach ($categorias as $c) {
        echo "id: " . $c->id . ', ';
        echo "nome: " . $c->nome . "<br>";
    }
});

//Soft Deletes

//Todos os dados do banco, inclusive os excluidos
Route::get('/todas', function () {
    $categorias = Categoria::withTrashed()->get();
    foreach ($categorias as $c) {
        echo "id: " . $c->id . ', ';
        echo "nome: " . $c->nome;
        if ($c->trashed()) {
            echo ' (apagado)<br>';
        }else{
            echo '<br>';
        }
    }
});

//Buscando os dados apagados

Route::get('/ver/{id}', function($id){
    //$cat = Categoria::withTrashed()->find($id);
    $cat = Categoria::withTrashed()
        ->where('id', $id)
        ->get()
        ->first();

    if (isset($cat)) {
        echo "id: " . $cat->id . ', ';
        echo "nome: " . $cat->nome . "<br>";
    }else{
        echo "<h1>Categoria não encontrada</h1>";
    }
});

//Buscando os dados apagados(apenas os dados apagados)

Route::get('/somenteapagadas', function(){
    $categorias = Categoria::onlyTrashed()->get();

    foreach ($categorias as $c) {
        echo "id: " . $c->id . ', ';
        echo "nome: " . $c->nome;
        if ($c->trashed()) {
            echo ' (apagado)<br>';
        }else{
            echo '<br>';
        }
    }
});

//Restaurando os dados deletados

Route::get('/restaurar/{id}', function($id){
    $cat = Categoria::withTrashed()->find($id);

    if (isset($cat)) {
        $cat->restore();
        echo "Categoria Restaurada: " . $cat->id . '<br>';
        echo  "<a href = \"/listcat\">Listar todas </a> ";
    }else{
        echo "<h1>Categoria não encontrada</h1>";
    }
});

//Apagando Registros Permanentemente

Route::get('/apagarpermanente/{id}', function($id){
    $cat = Categoria::withTrashed()->find($id);

    if (isset($cat)) {
        $cat->forceDelete();
        return redirect('/listcat');
    }else{
        echo "<h1>Categoria não encontrada</h1>";
    }
});
