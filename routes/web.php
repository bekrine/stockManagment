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


/* route return the Home View */
Route::get('/', function(){
    return view('pages.home');
})->name('home');


/* Delete route to delete a product in the stock*/ 
Route::delete('/stock/{stockId}', [StockController::class,'destroy'])->name('stock.destroy');

/* get route returns an edit view with product went to update*/
Route::get('/stock/{stockId}/edit', [StockController::class,'edit'])->name('stock.edit');

/*put route made the update  to the product */
Route::put('/stock/{stockId}', [StockController::class,'update'])->name('stock.update');

/*get route return products in stock sort asc or desc  */
Route::get('/stocks', [StockController::class, 'index'])->name('stock.index');

/*return the products in the stock */
Route::get('/stock', [StockController::class,'getStock'])->name('stock');


/*return the create page for the product */
Route::get('/products/create', [ProductController::class,'create'])->name('product.create');

/*post route to add the product to the stock */
Route::post('/products', [ProductController::class,'store']);

/*return the recipes possible based on the products in the stock*/
Route::get('/recipes', [RecipeController::class,'getPossibleRecipes'])->name('recipe');

/* Validate the recipe by subtracting quantity from stock*/
Route::post('/recipes/{recipeId}/validate', [RecipeController::class,'validateRecipe'])->name('recipes.validate');