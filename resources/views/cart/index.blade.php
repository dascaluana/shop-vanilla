@extends ('layouts2.master')

@section('content')

<form method="POST" action="/cart">
    {{ csrf_field() }}

@if ((session()->get('id')))
    <table border="1">
        <tr>
            <th>{{ __('messages.Product') }}</th>
            <th>{{ __('messages.Image') }}</th>
            <th>{{ __('messages.Remove') }}</th>
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
                    <a href="/cart/{{ $product->id }}">{{ __('messages.Remove') }}</a>
                </td>
            </tr>
        @endforeach
    </table>
@endif
    <br />

    <table>
        <tr>
            <td>{{ __('messages.Name') }} :</td>
            <td><input type="text" name="name" value=""></td>
        </tr>

        <tr>
            <td>{{ __('messages.Email') }} :</td>
            <td><input type="text" name="email" value=""></td>
        </tr>

        <tr>
            <td>{{ __('messages.Comments') }}</td>
            <td><textarea name="comments" rows="5" cols="22"></textarea></td>
        </tr>

        <tr>
            <td><a href="/index">{{ __('messages.Go to index') }}</a></td>
            <td><input type="submit" name="submit" value="{{ __('messages.Checkout') }}"/></td>
        </tr>
    </table>
</form>

@endsection
