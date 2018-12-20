@extends ('layouts2.master')

@section('content')
    @if ($product->id)
        <table>
            <tr>
                @if ($product->title)
                    <td>
                        <b>{{ __('messages.Title') }}:</b>
                    </td>
                    <td>
                        {{ $product->title }}
                    </td>
                @endif
            </tr>

            <tr>
                @if ($product->description)
                    <td>
                        <b>{{ __('messages.Description') }}:</b>
                    </td>
                    <td>
                        {{ $product->description }}
                    </td>
                @endif
            </tr>

            <tr>
                @if ($product->price)
                    <td>
                        <b>{{ __('messages.Price') }}:</b>
                    </td>
                    <td>
                        {{ $product->price }}
                    </td>
                @endif
            </tr>

            <tr>
                @if ($product->image)
                    <td>
                        <b>{{ __('messages.Image') }}:</b>
                    </td>
                    <td>
                        <img src="{{ asset('storage/images/' . $product->image) }}" width="50" height="50"/>
                    </td>
                @endif
            </tr>
        </table>
    @endif
@endsection
