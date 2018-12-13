<tr>
    <td>
        @if (strlen($product->title))
            <b>Title: </b> {{ $product->title }}<br />
        @endif

        @if (strlen($product->description))
            <b>Description: </b> {{ $product->description }}<br />
        @endif

        @if (strlen($product->price))
            <b>Price: </b> {{ $product->price }}
        @endif
    </td>
    <td align="center">
        <a href="">Add</a>
    </td>
</tr>

