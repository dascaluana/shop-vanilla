@extends ('layouts2.master')

@section('content')
    @if ($product->id)
        <table border="1">
            <tr>
                <th>{{ __('messages.Title') }}</th>
                <th>{{ __('messages.Description') }}</th>
                <th>{{ __('messages.Price') }}</th>
                <th>{{ __('messages.Image') }}</th>
            </tr>
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
                    @if (strlen($product->image))
                        <img src="{{ asset('storage/images/' . $product->image) }}" width="50" height="50"/>
                    @endif
                </td>
            </tr>
        </table>
    @endif
@endsection
