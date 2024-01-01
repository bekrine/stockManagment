<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        // Afficher la page d'ajout de produits alimentaires
        $products = Product::all();
        return view('pages.addProduct',['products'=>$products]);
        }
    
    public function store(Request $request)
    {
        // Valider et enregistrer les produits dans la base de données

        $product = $request->validate([
            'product' => 'required|string|max:255', 
            'quantity' => 'required|numeric',
            'expiration_date' => 'required|date',
        ]);
        Stock::create([
            'product_id' => $product['product'],
            'quantity' => $product['quantity'],
            'expiration_date' => $product['expiration_date'],
        ]);
        return redirect('/products/create')->with('success', 'Product added successfully.');
    }
}
