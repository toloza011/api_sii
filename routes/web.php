<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiiController;

Route::get('/',[SiiController::class,'index'])->name('home');
Route::post('/consultar',[SiiController::class,'consultar'])->name('consultar');
Route::post('/guardar',[SiiController::class,'guardar'])->name('guardar');
Route::get('/editar/{id}',[SiiController::class,'editar'])->name('editar');
Route::post('/update/{id}',[SiiController::class,'update'])->name('update');
Route::post('/delete/{id}',[SiiController::class,'delete'])->name('delete');