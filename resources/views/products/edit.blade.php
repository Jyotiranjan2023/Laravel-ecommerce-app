<h2>Edit Product</h2>
<form method="POST" action="/products/{{ $product->id }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <input type="number" name="price" value="{{ $product->price }}"><br><br>

    <input type="file" name="image"><br><br>

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="100"><br>
    @endif

    <button type="submit">Update</button>
</form>