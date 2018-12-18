@extends ('layouts2.master')

@section('content')
<table border="1">
    <tr>
        <th>{{ __('messages.Product') }}</th>
        <th>{{ __('messages.Image') }}</th>
        <th>{{ __('messages.Add to cart') }}</th>
    </tr>
    <tr>
        @foreach ($products as $product)
            @include ('shop.show')
        @endforeach
    </tr>
</table>

<a href="/cart">{{ __('messages.Go to cart') }}</a>
@endsection
