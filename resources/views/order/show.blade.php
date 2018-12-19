@extends ('layouts2.master')

@section('content')
    <table border="1">
        <tr>
            <th>{{ __('messages.Title') }}</th>
            <th>{{ __('messages.Description') }}</th>
            <th>{{ __('messages.Price') }}</th>
            <th>{{ __('messages.Image') }}</th>
        </tr>
        @foreach($order->products as $product)
            <tr>
                <td>
                    @if (strlen($product->title))
                        {{ $product->title }}<br />
                    @endif
                </td>

                <td>
                    @if (strlen($product->description))
                        {{ $product->description }}<br />
                    @endif
                </td>

                <td>
                    @if (strlen($product->price))
                        {{ $product->price }}
                    @endif
                </td>

                <td>
                    @if (strlen($product->image))
                        <img src="{{ asset('storage/images/' . $product->image) }}" width="50" height="50"/>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <b>{{ __('messages.Info Order') }}: </b><br />
    <b>{{ __('messages.Name') }}: </b>{{ $order->name }}<br />
    <b>{{ __('messages.Email') }}</b>: {{ $order->email }}<br />
    <b>{{ __('messages.Comments') }}</b>: {{ $order->comments }}<br />
    <b>{{ __('messages.Date') }}</b>: {{ $order->created_at }}<br />

    <a href="/orders">{{ __('messages.Orders') }}</a>
@endsection
