@extends ('layouts2.master')

@section('content')
    <table border="1">
        <tr>
            <th>{{ __('messages.Title') }}</th>
            <th>{{ __('messages.Description') }}</th>
            <th>{{ __('messages.Price') }}</th>
        </tr>
        <tr>
            @foreach($products as $product)
                @include ('order.product')
            @endforeach
        </tr>
    </table>
@endsection
