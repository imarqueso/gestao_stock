<?php

use App\Http\Controllers\Auth\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\NotasController;
use App\Http\Controllers\Auth\PerfilController;
use App\Http\Controllers\Auth\ProdutosController;
use App\Http\Controllers\Auth\UsuariosController;
use App\Http\Controllers\Auth\VendasController;
use App\Http\Middleware\Authenticate;


Route::middleware(['Colaborador'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'view'])->name('perfilView');
    Route::post('/perfil/{id}/editar', [PerfilController::class, 'editar'])->name('editarPerfil');
});


Route::middleware(['Admin'])->group(function () {
    // Produtos
    Route::get('/usuarios', [UsuariosController::class, 'view'])->name('usuariosView');
    Route::post('usuarios/cadastrar', [UsuariosController::class, 'cadastrar'])->name('cadastrarUsuario');
    Route::post('/usuarios/{id}/editar', [UsuariosController::class, 'editar'])->name('editarUsuario');
    Route::post('/usuarios/{id}/excluir', [UsuariosController::class, 'excluir'])->name('excluirUsuario');
});


Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('dashboard.index');
    });
    Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboardView');

    // Produtos
    Route::get('/produtos', [ProdutosController::class, 'view'])->name('produtosView');
    Route::post('produtos/cadastrar', [ProdutosController::class, 'cadastrar'])->name('cadastrarProduto');
    Route::post('/produtos/{id}/vender', [ProdutosController::class, 'vender'])->name('venderProduto');
    Route::post('/produtos/{id}/editar', [ProdutosController::class, 'editar'])->name('editarProduto');
    Route::post('/produtos/{id}/excluir', [ProdutosController::class, 'excluir'])->name('excluirProduto');

    // Vendas
    Route::get('/vendas', [VendasController::class, 'view'])->name('vendasView');
    Route::post('/vendas/cadastrar', [VendasController::class, 'cadastrar'])->name('cadastrarVenda');
    Route::post('/vendas/{id}/excluir', [VendasController::class, 'excluir'])->name('excluirVenda');

    // Notas
    Route::get('/notas', [NotasController::class, 'view'])->name('notasView');
    Route::post('/notas/cadastrar', [NotasController::class, 'cadastrar'])->name('cadastrarNota');
    Route::get('/notas/{id}', [NotasController::class, 'nota'])->name('nota');
});

Route::get('/login', [LoginController::class, 'loginView'])->name('loginView');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/login', 'Auth\LoginController@loginView')->name('loginView');
// Route::post('/login', 'Auth\LoginController@login')->name('login');
// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
