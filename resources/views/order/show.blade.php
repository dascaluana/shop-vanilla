@extends ('layouts2.master')

@section('content')
    <table>
        @if ($order->name)
        <tr>
            <td>
                <b>{{ __('messages.Name') }}:</b>
            </td>
            <td>
                {{ $order->name }}
            </td>
        </tr>
        @endif

        @if ($order->email)
            <tr>
                <td>
                    <b>{{ __('messages.Email') }}:</b>
                </td>
                <td>
                    {{ $order->email }}
                </td>
            </tr>
        @endif

        @if ($order->comments)
            <tr>
                <td>
                    <b>{{ __('messages.Comments') }}:</b>
                </td>
                <td>
                    {{ $order->comments }}
                </td>
            </tr>
        @endif

        @if ($order->created_at)
            <tr>
                <td>
                    <b>{{ __('messages.Date') }}:</b>
                </td>
                <td>
                    {{ $order->created_at }}
                </td>
            </tr>
        @endif
    </table>

    @if ($order->products->count())
        <table border="1">
            <tr>
                <th>{{ __('messages.Title') }}</th>
                <th>{{ __('messages.Description') }}</th>
                <th>{{ __('messages.Price') }}</th>
                <th>{{ __('messages.Image') }}</th>
            </tr>
            @foreach($order->products as $product)
                <tr>
                    @if (strlen($product->title))
                        <td>
                            {{ $product->title }}
                        </td>
                    @endif

                    @if (strlen($product->description))
                        <td>
                            {{ $product->description }}
                        </td>
                    @endif

                    @if (strlen($product->price))
                        <td>
                            {{ $product->price }}
                        </td>
                    @endif

                    @if (strlen($product->image))
                        <td>
                            <img src="{{ asset('storage/images/' . $product->image) }}" width="50" height="50"/>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    @endif

    <a href="/orders">{{ __('messages.Orders') }}</a>
@endsection
