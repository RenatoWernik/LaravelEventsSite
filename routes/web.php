<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, "index"]); //index é o padrao que mostra todos os registros
Route::get('/events/create', [EventController::class, "create"])->middleware("auth");//create é padrao que cria registros no banco
Route::get('/contact', [EventController::class, "contact"]);
Route::post("/events", [EventController::class, "store"]); /* store envia e salva os dados no banco// vai jogar toda a logica de adição de novos dados(post) para a classe store, que foi criada no EventController*/
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::get("/events/{id}", [EventController::class, "show"]);// show é o padrao que mostra um dado em especifico{id}
Route::get("/dashboard", [EventController::class, "dashboard"])->middleware("auth");



Route::get('/produtos', function () {
    $busca = request("search");


    return view('products',["busca"=>$busca]);
});

Route::get('/produtos_teste/{id?}', function ($id=null) {
    return view('product',["id"=>$id]);
});
