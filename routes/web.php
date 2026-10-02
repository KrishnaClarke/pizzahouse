<?php

use App\Http\Controllers\PizzaController;
use Illuminate\Support\Facades\Route;

// Customer-facing
Route::view('/', 'welcome');
Route::get('/pizzas/create', [PizzaController::class, 'create']);
Route::post('/pizzas', [PizzaController::class, 'store']);

// Staff-only (HTTP Basic, see App\Http\Middleware\AdminOnly)
Route::middleware('admin')->group(function () {
    Route::get('/pizzas', [PizzaController::class, 'index']);
    Route::get('/pizzas/{pizza}', [PizzaController::class, 'show'])->whereNumber('pizza');
    Route::patch('/pizzas/{pizza}/complete', [PizzaController::class, 'complete'])->whereNumber('pizza');
    Route::delete('/pizzas/{pizza}', [PizzaController::class, 'destroy'])->whereNumber('pizza');
});
