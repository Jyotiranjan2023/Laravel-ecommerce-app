<h2>All Products</h2>

<a href="/products/create">Add Product</a>

<br><br>

<!-- 🔍 Search (OUTSIDE loop) -->
<form method="GET" action="/products">
    <input type="text" name="search" value="{{ $search }}" placeholder="Search product...">
    <button type="submit">Search</button>
</form>

<br>

<ul>
@foreach($products as $product)

    <li style="margin-bottom:20px;">
        {{ $product->name }} - ₹{{ $product->price }}

        @if($product->image)
            <br>
            <img src="{{ asset('storage/' . $product->image) }}" width="100">
        @endif

        <br>

        <a href="/products/{{ $product->id }}/edit">Edit</a>

        <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </li>

@endforeach
</ul>

<!-- 📄 Pagination (OUTSIDE loop) -->
{{ $products->links() }}