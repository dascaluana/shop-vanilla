<tr>
    <td>
        @if (strlen($product->title))
            <b>{{ __('messages.Title') }}: </b> {{ $product->title }}<br />
        @endif

        @if (strlen($product->description))
            <b>{{ __('messages.Description') }}: </b> {{ $product->description }}<br />
        @endif

        @if (strlen($product->price))
            <b>{{ __('messages.Price') }}: </b> {{ $product->price }}
        @endif
    </td>
    <td align="center">
        <a href="/cart/{{ $product->id }}">{{ __('messages.Remove') }}</a>
    </td>
</tr>

