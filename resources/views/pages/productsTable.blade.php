@extends('layouts.app')

@section('content')
    <div class="flex flex-col mt-12">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b bg-white font-medium ">
                            <tr>
                                <th scope="col" class="px-6 py-4"></th>
                                <th scope="col" class="px-6 py-4  text-center">Name</th>
                                <th scope="col" class="px-6 py-4 text-center">
                                  <div class="flex justify-evenly">
                                    Quantity or weight
                                    <div >

                                      <div class="mb-2 cursor-pointer">
                                          <a
                                              href="{{ route('stock.index', ['sort' => 'quantity', 'order' => 'asc']) }}">
                                              <svg xmlns="http://www.w3.org/2000/svg" height="11" width="11"
                                                  viewBox="0 0 384 512">

                                                  <path
                                                      d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                              </svg>
                                          </a>
                                      </div>
                                      <div class="cursor-pointer">
                                          <a
                                              href="{{ route('stock.index', ['sort' => 'quantity', 'order' => 'desc']) }}">
                                              <svg xmlns="http://www.w3.org/2000/svg" height="11" width="11"
                                                  viewBox="0 0 384 512">

                                                  <path
                                                      d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                              </svg>
                                          </a>
                                      </div>
                                  </div>
                                  </div>
                                 </th>
                                <th scope="col" class="px-6 py-4 text-center">
                                    <div class="flex justify-evenly">
                                        Expiration Date
                                        <div >

                                            <div class="mb-2 cursor-pointer">
                                                <a
                                                    href="{{ route('stock.index', ['sort' => 'expiration_date', 'order' => 'asc']) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="11" width="11"
                                                        viewBox="0 0 384 512">

                                                        <path
                                                            d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="cursor-pointer">
                                                <a
                                                    href="{{ route('stock.index', ['sort' => 'expiration_date', 'order' => 'desc']) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="11" width="11"
                                                        viewBox="0 0 384 512">

                                                        <path
                                                            d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $index => $product)
                                <tr class="border-b bg-neutral-100 ">
                                    <td class="text-center whitespace-nowrap px-6 py-4 font-medium">{{ $index + 1 }}</td>
                                    <td class="text-center whitespace-nowrap px-6 py-4">{{ $product['name'] }}</td>
                                    <td class="text-center whitespace-nowrap px-6 py-4">{{ $product['quantity'] }}</td>
                                    <td class="text-center whitespace-nowrap px-6 py-4">
                                     <span class="{{today()->gt($product['expiration_date']) ? 'text-red-600' : '' }} ">
                                       {{ $product['expiration_date'] }}
                                      </span>
                                    </td>

                                    <td class="text-center whitespace-nowrap px-6 py-4 flex justify-evenly items-center ">
                                        <div>

                                            <form method="POST" action="/stock/{{ $product['id'] }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6 hover:text-red-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <a href="/stock/{{ $product['id'] }}/edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 hover:text-green-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @empty
                                <tr>Non Product</tr>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
@endsection
