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
        @foreach ($orders as $order)
            <tr>
                <td>
                    @if (strlen($order->created_at))
                        {{ $order->created_at }}<br />
                    @endif
                </td>

                <td>
                    @if (strlen($order->name))
                        {{ $order->name }}<br />
                    @endif
                </td>

                <td>
                    @if (strlen($order->email))
                        {{ $order->email }}
                    @endif
                </td>

                <td>
                    @if (strlen($order->comments))
                        {{ $order->comments }}
                    @endif
                </td>

                <?php
                $product = '';
                /** @var \App\Order $order */
                foreach($order->products as $val) {
                    $product .= '- ' . $val->title . PHP_EOL;
                }
                ?>

                <td>
                    <?= nl2br($product) ?>
                </td>

                <td>
                    <a href="order/{{ $order->id }}">{{ __('messages.View') }}</a>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
