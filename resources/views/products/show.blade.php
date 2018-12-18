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
        <img src="{{ asset('images/' . $product->image) }}" width="50" height="50"/>
    </td>
    <td align="center">
        <a href="{{ action("ProductController@edit", $product->id) }}">{{ __('messages.Edit') }}</a>

        <form method="post" action="{{action('ProductController@destroy', $product->id)}}">
            {{ csrf_field() }}
            @method('DELETE')

            <input type="submit" value="{{ __('messages.Delete') }}">
        </form>
    </td>
</tr>

