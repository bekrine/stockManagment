<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Stock;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function getPossibleRecipes()
    {
        // Retourner les recettes possibles en fonction des produits disponibles
        $availableProducts = Stock::pluck('product_id')->toArray();
        $possibleRecipes = Recipe::with('products')
        ->whereHas('products', function ($query) use ($availableProducts) {
            $query->whereIn('products.id', $availableProducts);
        })
        ->get();

        $possibleRecipes->each(function ($recipe) use ($availableProducts) {
            $missingProducts = array_diff(
                $recipe->products->pluck('id')->toArray(),
                $availableProducts
            );
            $recipe->missingProducts = $missingProducts;
        });
        return view('pages.recipes',['possibleRecipes'=>$possibleRecipes]);
    }
    public function validateRecipe(Request $request,$recipeId)
    {
        //Validate a recipe, update Stocks

        $recipe = Recipe::findOrFail($recipeId);

        $requiredProducts = $recipe->products()->pluck('id')->toArray();
        $requiredQuantities = $recipe->products()->pluck('quantity')->toArray();

        $stockProducts = Stock::whereIn('product_id', $requiredProducts)->get();

        foreach ($requiredProducts as $index => $productId) {
            $requiredQuantity = $requiredQuantities[$index];

            // Find the corresponding stock entry for the product
            $stockEntry = $stockProducts->where('product_id', $productId)->first();

            // Check if the product is available in the required quantity
            if (!$stockEntry || $stockEntry->quantity < $requiredQuantity) {
                return redirect()->back()->with('error', 'Not enough products to validate the recipe');
            }
        }


        foreach ($requiredProducts as $index => $productId) {
            $requiredQuantity = $requiredQuantities[$index];

            // Find the corresponding stock entry for the product
            $stockEntry = $stockProducts->where('product_id', $productId)->first();

            // Subtract the required quantity from the stock
            $stockEntry->update([
                'quantity' => $stockEntry->quantity - $requiredQuantity,
            ]);
        }

        return redirect()->back()->with('success', 'Recipe validated successfully');
    }

}
