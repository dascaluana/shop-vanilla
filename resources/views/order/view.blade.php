@extends ('layouts2.master')

@section('content')
    <table border="1">
        <tr>
            <th>{{ __('messages.Title') }}</th>
            <th>{{ __('messages.Description') }}</th>
            <th>{{ __('messages.Price') }}</th>
            <th>{{ __('messages.Image') }}</th>
        </tr>
        <tr>
            @foreach($products as $product)
                @include ('order.product')
            @endforeach
        </tr>
    </table>
    <a href="/orders">{{ __('messages.Orders') }}</a>
@endsection
