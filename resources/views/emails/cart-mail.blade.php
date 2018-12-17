<?php
/** @var \App\Order $order */
?>
<!DOCTYPE html>
<html>
<body>

{{ __('messages.Name') }}: {{ $order->name }} <br />
{{ __('messages.Comments') }}: {{ $order->comments }} <br />


<table border="1">
   <tr>
       <th>{{ __('messages.Title') }}</th>
       <th>{{ __('messages.Description') }}</th>
       <th>{{ __('messages.Price') }}</th>
   </tr>
    <tr>
        @foreach ($order->products as $product)
            <td>
                {{ $product->title }}
            </td>
            <td>
                {{ $product->description }}
            </td>
            <td>
                {{ $product->price }}
            </td>
        @endforeach
    </tr>
</table>

</body>
</html>
