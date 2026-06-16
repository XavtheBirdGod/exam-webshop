@foreach($products as $index => $product)
    <x-product-card
        :id="$product->id"
        :name="$product->name"
        :collection="$product->collection"
        :price="(tenant('currency_symbol') ?? '€') . number_format($product->price, 2)"
        :img="$product->image_url"
    />
@endforeach
