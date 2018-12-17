@extends ('layouts2.master')

@section('content')
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif

    <table border="1">
        <tr>
            <th>{{ __('messages.Product') }}</th>
            <th>{{ __('messages.Edit') }}/{{ __('messages.Delete') }}</th>
        </tr>
        <tr>
            @foreach ($products as $product)
                @include ('products.show')
            @endforeach
        </tr>
    </table>

    <a href="{{ action("ProductController@create") }}">{{ __('messages.Add') }}</a>

    <a href="/logout">{{ __('messages.Logout') }}</a>

@endsection
