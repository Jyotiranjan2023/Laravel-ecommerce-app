@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">All Products</h2>

        <a href="/products/create"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            + Add Product
        </a>
    </div>

    <!-- SEARCH -->
    <form method="GET" action="/products" class="flex gap-2 mb-6">
        <input type="text" name="search" value="{{ $search ?? '' }}"
               placeholder="Search products..."
               class="w-full max-w-md border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Search
        </button>
    </form>

    <!-- GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($products as $product)

        <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 flex flex-col">

            <!-- IMAGE -->
            <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         class="w-full h-full object-cover">
                @else
                    <span class="text-gray-400">No Image</span>
                @endif
            </div>

            <!-- CONTENT -->
            <div class="p-4 flex flex-col flex-grow">

                <a href="/products/{{ $product->id }}">
                    <h3 class="font-semibold text-lg hover:text-blue-600 truncate">
                        {{ $product->name }}
                    </h3>
                </a>

                <p class="text-gray-600 mt-1 mb-3">
                    ₹{{ number_format($product->price, 2) }}
                </p>

                <!-- BUTTONS -->
                <div class="mt-auto flex gap-2">

                    <form action="/cart/add/{{ $product->id }}" method="POST">
                        @csrf
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Add
                        </button>
                    </form>

                    <a href="/products/{{ $product->id }}/edit"
                       class="bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded text-sm">
                        Edit
                    </a>

                    <form action="/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- PAGINATION -->
    <div class="mt-8">
        {{ $products->links() }}
    </div>

</div>

@endsection