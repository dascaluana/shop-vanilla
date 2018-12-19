@extends ('layouts2.master')

@section('content')
@if ($products->count())
    <table border="1">
        <tr>
            <th>{{ __('messages.Product') }}</th>
            <th>{{ __('messages.Image') }}</th>
            <th>{{ __('messages.Add to cart') }}</th>
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
                    <a href="/index/{{ $product->id }}">{{ __('messages.Add') }}</a>
                </td>

            </tr>
        @endforeach
    </table>
@endif
<a href="/cart">{{ __('messages.Go to cart') }}</a>
@endsection
