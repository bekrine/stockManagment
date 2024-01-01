<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\StockController;
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

Route::delete('/stock/{stockId}', [StockController::class,'destroy'])->name('stock.destroy');
Route::get('/stock/{stockId}/edit', [StockController::class,'edit'])->name('stock.edit');

Route::put('/stock/{stockId}', [StockController::class,'update'])->name('stock.update');

Route::get('/', function(){
    return view('pages.home');
});
Route::get('/stocks', [StockController::class, 'index'])->name('stock.index');

Route::get('/products/create', [ProductController::class,'create']);
Route::post('/products', [ProductController::class,'store']);

Route::get('/stock', [StockController::class,'getStock']);

Route::get('/recipes', [RecipeController::class,'getPossibleRecipes']);
Route::post('/recipes/{recipeId}/validate', [RecipeController::class,'validateRecipe'])->name('recipes.validate');