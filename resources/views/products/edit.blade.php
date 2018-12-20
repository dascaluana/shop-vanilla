@extends ('layouts2.master')
@section('content')
<form method="post" action="{{action('ProductController@update', $product->id)}}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input name="_method" type="hidden" value="PATCH">

    <table>
        <tr>
            <td>{{ __('messages.Title') }}:</td>
            <td>
                <input type="text" name="title" value="{{ $product->title }}">
            </td>
        </tr>

        <tr>
            <td>{{ __('messages.Description') }}:</td>
            <td>
                <textarea type="text" name="description" rows="5" cols="22">{{ $product->description }}</textarea>
            </td>
        </tr>

        <tr>
            <td>{{ __('messages.Price') }}:</td>
            <td>
                <input type="text" name="price"  value="{{ $product->price }}">
            </td>
        </tr>

        <tr>
            <td>{{ __('messages.Image') }}:</td>
            <td>
                <img src="{{ asset('storage/images/' . $product->image) }}" width="50" height="50"/>
                <input type="file" name="image" id="image"/>
            </td>
        </tr>

        <tr>
            <td><a href="/products">{{ __('messages.Products') }}</a>
            <td><input type="submit" name="submit" value="{{ __('messages.Save') }}"/></td>
        </tr>
    </table>

</form>

@include ('layouts.errors')
@endsection