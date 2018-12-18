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
    <td>
        <img src="{{ asset('storage/images/' . $product->image) }}" width="50" height="50"/>
    </td>
    <td align="center">
        <a href="/cart/{{ $product->id }}">{{ __('messages.Remove') }}</a>
    </td>
</tr>

