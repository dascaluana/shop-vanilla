@extends ('layouts2.master')

@section('content')

<form method="POST" action="/cart">
    {{ csrf_field() }}

    <table border="1">
        <tr>
            <th>{{ __('messages.Product') }}</th>
            <th>{{ __('messages.Remove') }}</th>
        </tr>
        <tr>
            @foreach ($products as $product)
                @include ('cart.show')
            @endforeach
        </tr>
    </table>

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
