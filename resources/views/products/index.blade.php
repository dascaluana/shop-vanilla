@extends ('layouts2.master')

@section('content')
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif

    @if ($products->count())
    <table border="1">
        <tr>
            <th>{{ __('messages.Product') }}</th>
            <th>{{ __('messages.Image') }}</th>
            <th>{{ __('messages.Edit') }}/{{ __('messages.Delete') }}</th>
        </tr>
        @foreach ($products as $product)
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
                    @if (strlen($product->image))
                        <img src="{{ asset('storage/images/' . $product->image) }}" width="50" height="50"/>
                    @endif
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
        @endforeach
    </table>
    @endif

    <a href="{{ action("ProductController@create") }}">{{ __('messages.Add') }}</a>

    <a href="/logout">{{ __('messages.Logout') }}</a>

@endsection
