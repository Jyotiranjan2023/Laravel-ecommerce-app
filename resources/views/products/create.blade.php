<h2>Add Product</h2>

<form method="POST" action="/products" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Product Name"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="number" name="price" placeholder="Price"><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit">Add Product</button>
</form>