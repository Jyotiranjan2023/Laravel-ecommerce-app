<h2>Add Product</h2>

<form method="POST" action="/products">
    @csrf

    <input type="text" name="name" placeholder="Product Name"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="price" placeholder="Price"><br><br>

    <button type="submit">Add Product</button>
</form>