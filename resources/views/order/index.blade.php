@extends ('layouts2.master')

@section('content')
    <table border="1">
        <tr>
            <th>{{ __('messages.Date') }}</th>
            <th>{{ __('messages.Name') }}</th>
            <th>{{ __('messages.Email') }}</th>
            <th>{{ __('messages.Comments') }}</th>
            <th>{{ __('messages.Product') }}</th>
            <th>{{ __('messages.View') }}</th>
        </tr>
        <tr>
            @foreach ($orders as $order)
                @include ('order.show')
            @endforeach
        </tr>
    </table>

@endsection
