@extends ('layouts2.master')

@section('content')

@if ($orders->count())
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
                @if (strlen($order->created_at))
                    <td>{{ $order->created_at }}</td>
                @endif

                @if (strlen($order->name))
                    <td>{{ $order->name }}</td>
                @endif

                @if (strlen($order->email))
                    <td>{{ $order->email }}</td>
                @endif
                @if (strlen($order->comments))
                    <td>{{ $order->comments }}</td>
                @endif

                <?php
                $product = '';
                /** @var \App\Order $order */
                foreach($order->products as $val) {
                    $product .= '- ' . $val->title . PHP_EOL;
                }
                ?>

                @if (strlen($product))
                    <td>
                        <?= nl2br($product) ?>
                    </td>
                @endif

                <td>
                    <a href="order/{{ $order->id }}">{{ __('messages.View') }}</a>
                </td>
            </tr>
        @endforeach
    </table>
@endif

@endsection
