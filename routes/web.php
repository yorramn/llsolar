<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Clientes\CadastrarCliente;
use App\Http\Livewire\Clientes\create;
use App\Http\Livewire\Funcionarios\funcionario;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
  return redirect('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    //Rota do DashBoard
    Route::get('dashboard', Dashboard::class)->name('dashboard');

    //Rotas do cadastro de clientes
    Route::get('cliente', \App\Http\Livewire\Cliente\Cliente::class)->name('customer.create');
    Route::get('clientes', App\Http\Livewire\Cliente\Clientes::class)->name('customers');

    //Rotas do cadastro de Funcionários e permissões
    Route::get('funcionario', \App\Http\Livewire\Funcionarios\Funcionario::class)->name('employee.create');
    Route::get('lista-funcionarios', \App\Http\Livewire\Funcionarios\ListaFuncionarios::class)->name('employees');

    //Rotas do gerenciamento do perfil conectado
    Route::get('perfil', \App\Http\Livewire\Usuarios\Perfil::class)->name('profile');
    Route::get('troca-senha', \App\Http\Livewire\Usuarios\TrocaSenha::class)->name('troca-senha');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
