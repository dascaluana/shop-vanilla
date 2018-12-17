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

<a href="orders">{{ __('messages.Orders') }}</a>



