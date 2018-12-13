@extends ('layouts2.master')

@section('content')
<table border="1">
    <tr>
        <th>Product</th>
        <th>Add to cart</th>
    </tr>
    <tr>
        @foreach ($products as $product)
            @include ('shop.show')
        @endforeach
    </tr>
</table>

@endsection
