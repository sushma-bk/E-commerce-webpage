<!DocType html>
<html lang="en">
<head>
    <title>Blade template</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="grid">
    @foreach ($data as $product)
        <div class="grid-item">
            <!-- Content for each grid item -->
            <h3>{{ $product->name }}</h3>
            <img src="{{ $product->images }}">
            <p>{{ $product->price }}</p>
            <p>{{ $product->description }}</p>

            <!-- Buy Now Button -->
            <form action="/session" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type='hidden' name="productName" value="{{ $product->name }}">
                <input type="hidden" name="image" value="{{ $product->images }}">
                <input type='hidden' name="price" value="{{ $product->price }}">
                <input type="hidden" name="description" value="{{ $product->description }}">
                <button class="buy-now-button" type="submit">Buy Now</button>
            </form>

        </div>
    @endforeach
</div>
</body>
</html>
