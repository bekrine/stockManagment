@extends('layouts.app')

@section('content')
<div class=" flex justify-center items-center h-screen">

<form action="/stock/{{$productStock['0']['id']}}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-[50%] min-h-[20rem]" >
    @csrf 
    @method('PUT')
      <div class="mb-4">

          <label for="" class="block text-gray-700 text-sm font-bold mb-2">Choose a Product</label>
          <select name="product" id="" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
              <option selected value="{{$productStock['0']['productId']}}">{{$productStock['0']['name']}}</option>                    
              @forelse ($products as $product)
              <option value="{{$product->id}}">{{$product->name}}</option>
              @empty
              <option value="">No Product Exicter</option>                    
              
              @endforelse
            </select>
            @error('product')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>
        
        <div>
          <label for="" class="block text-gray-700 text-sm font-bold mb-2">Quantity or Wieght</label>
          <input type="text" value="{{$productStock['0']['quantity']}}"  id="quantityInput" name="quantity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
     
          @error('quantity')
                  <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
      </div>
      <div>
          <label for="" class="block text-gray-700  text-sm font-bold mb-2">Expiration Date</label>
          <input value="{{$productStock['0']['expiration_date']}}" type="date" name="expiration_date" id="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          @error('expirationDate')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
          @enderror
      </div>
      <div class="mt-6">

          <button 
          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
          type="submit">Update Product</button>
        </div>
  </form>
  @if (session('success'))
  <div class="fixed top-0 left-0 bg-green-400 text-white px-10 py-5">
      {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div class="fixed top-0 left-0 bg-red-400 text-white px-10 py-5">
      {{ session('error') }}
  </div>
@endif
</div>

 
@endsection