<h2>All Products</h2>

<a href="/products/create">Add Product</a>

<ul>
@foreach($products as $product)


<li>
    {{ $product->name }} - ₹{{ $product->price }}

    <a href="/products/{{ $product->id }}/edit">Edit</a>

    <form action="/products/{{ $product->id }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</li>
    
@endforeach
</ul>
