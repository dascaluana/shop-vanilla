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

    <td>
        <a href="order/{{ $order->id }}">{{ __('messages.View') }}</a>
    </td>
</tr>

