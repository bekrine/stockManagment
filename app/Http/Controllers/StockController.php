<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function getStock() {
        //return the stock page with the products in the stock
      $products = Stock::with('product')->get();
      $stockDetails = $products->map(function ($item) {
        return [
            'id'=> $item->id,
            'name' => $item->product->name,
            'quantity' => $item->quantity,
            'expiration_date' => $item->expiration_date,
        ];
     });

        return view('pages.productsTable',['products'=>$stockDetails]);
    }

    public function edit($stockId){
        
        //return the edit page with the product to edit
        $stockItem = Stock::with('product')->where('id', $stockId)->get();
        
        $stockDetails = $stockItem->map(function ($item) {
            return [
                'id'=> $item->id,
                'name' => $item->product->name,
                'quantity' => $item->quantity,
                'expiration_date' => $item->expiration_date,
                'productId' => $item->product->id
            ];
        });
        $products = Product::all();

        return view('pages.editProduct',['productStock' => $stockDetails , 'products' => $products]);
    }

    public function update(Request $request,$stockId){

        //update the product 

        $product = $request->validate([
            'product' => 'required|string|max:255', 
            'quantity' => 'required|numeric',
            'expiration_date' => 'required|date',
        ]);

        $stockItem = Stock::where('id', $stockId)->firstOrFail();

        $stockItem->update([
            'product' => $product['product'],
            'quantity' => $product['quantity'],
            'expiration_date' => $product['expiration_date']
        ]);

        return redirect('/stock')->with('success', 'Product updated in stock successfully');

    }

    public function destroy($stockId){
        //delete the product
        $stockItem = Stock::where('id', $stockId)->firstOrFail();
        $stockItem->delete();
        return redirect()->back()->with('success', 'Product deleted from stock successfully');

    }


    public function index(Request $request)
    {
        //return the products in the stock sort by asc or desc
        $sort = $request->input('sort', 'expiration_date');
        $order = $request->input('order', 'asc');

        $products = Stock::orderBy($sort, $order)->get();

        return view('pages.productsTable', ['products' => $products]);
    }

}
