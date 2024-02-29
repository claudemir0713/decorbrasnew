<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\menu\menuController;
use App\Http\Controllers\pedido\pedidoController;

Auth::routes(['logout'=>false]);

Route::get('/', function () {
    return view('auth/login');
});

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/',[HomeController::class,'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');;
    Route::get('/public', [HomeController::class, 'index']);
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

    /********************************** menu ***************************************************************/
    Route::group(['namespace' => 'menu'], function () {
        Route::get('menu',[menuController::class,'listAllmenu'])->name('menu.listAll');
        Route::get('menu/novo',[menuController::class,'formAddmenu'])->name('menu.formAddmenu');
        Route::get('menu/editar/{menu}',[menuController::class,'formEditmenu'])->name('menu.formEditmenu');
        Route::post('menu/store',[menuController::class,'stroremenu'])->name('menu.store');
        Route::patch('menu/edit/{menu}',[menuController::class,'edit'])->name('menu.edit');
        Route::delete('menu/destroy/{menu}',[menuController::class,'destroy'])->name('menu.destroy');

        Route::get('menu/menuUsuario',[MenuController::class,'menuUsuario'])->name('menu.menuUsuario');
        Route::post('menu/disponivel',[MenuController::class,'disponivel'])->name('menu.disponivel');
        Route::post('menu/menuLiberado',[MenuController::class,'menuLiberado'])->name('menu.menuLiberado');

        Route::post('menu/addMenuUsuario',[MenuController::class,'addMenuUsuario'])->name('menu.addMenuUsuario');
        Route::post('menu/removeMenuUsuario',[MenuController::class,'removeMenuUsuario'])->name('menu.removeMenuUsuario');

    });

    /********************************** menu ***************************************************************/
    Route::group(['namespace' => 'pedidos'], function () {
        Route::get('pedido',[pedidoController::class,'listAll'])->name('pedido.listAll');
        Route::get('pedido/novo',[pedidoController::class,'add'])->name('pedido.add');
        Route::get('pedido/editar/{pedido}',[pedidoController::class,'edit'])->name('pedido.edit');
        Route::post('pedido/store',[pedidoController::class,'store'])->name('pedido.store');
        Route::patch('pedido/edit/{pedido}',[pedidoController::class,'update'])->name('pedido.update');



        Route::post('pedido/buscaNomeProdutoDimensao',[pedidoController::class,'buscaNomeProdutoDimensao'])->name('pedido.buscaNomeProdutoDimensao');
        Route::post('pedido/consultaObsCliente',[pedidoController::class,'consultaObsCliente'])->name('pedido.consultaObsCliente');
        Route::post('pedido/consultaCreditoCliente',[pedidoController::class,'consultaCreditoCliente'])->name('pedido.consultaCreditoCliente');
        Route::post('pedido/consultaCliente',[pedidoController::class,'consultaCliente'])->name('pedido.consultaCliente');
        Route::post('pedido/listaProduto',[pedidoController::class,'listaProduto'])->name('pedido.listaProdutop');

    });

});
