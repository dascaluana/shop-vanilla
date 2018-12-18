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
        <img src="{{ asset('images/' . $product->image) }}" width="50" height="50"/>
    </td>
</tr>




