@extends('layouts.app')

@section('content')

    <h2 class="text-center m-6 text-xl font-bold">Possible Recipes</h2>
    @if ($possibleRecipes->isEmpty())
        <p>No recipes are possible with the current stock.</p>
    @else
        <div class="grid grid-cols-3 gap-4 mx-4">

            @foreach ($possibleRecipes as $recipe)
                <div
                    class="max-w-sm p-6 flex flex-col items-center justify-center bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $recipe->name }}
                    </h5>
                    @foreach ($recipe->products as $product)
                        <li class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ $product->name }}
                            ({{ $product->pivot->quantity }})
                            @if (in_array($product->id, $recipe->missingProducts))
                                <span class="inline-flex ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" width="16" height="16"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M8 0C3.58 0 0 3.58 0 8s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8zm0 14.5C4.41 14.5 1.5 11.59 1.5 8S4.41 1.5 8 1.5 14.5 4.41 14.5 8 11.59 14.5 8 14.5zm.47-9.97L7 7.54 5.47 6.03c-.1-.1-.24-.14-.37-.14s-.27.04-.37.14c-.2.2-.2.51 0 .71l1.88 1.88-1.88 1.88c-.2.2-.2.51 0 .71s.51.2.71 0L7 8.46l1.53 1.51c.2.2.51.2.71 0s.2-.51 0-.71L8.46 7l1.51-1.53c.2-.2.2-.51 0-.71s-.51-.2-.71 0z" />
                                    </svg>
                                </span>
                            @endif
                        </li>
                    @endforeach
                    <form method="POST" action="{{ route('recipes.validate', ['recipeId' => $recipe->id]) }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            validate
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

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
    @endif

@endsection
