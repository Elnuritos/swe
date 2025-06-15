@component('mail::message')
# Order #{{ $order->id }}

@foreach($order->items as $item)
- **{{ $item->product->name }}** x{{ $item->quantity }} — ${{ number_format($item->price,2) }}
@endforeach

**Total: ${{ number_format($order->total,2) }}**

@component('mail::button', ['url' => url("/payment/{$order->id}")])
Pay Now
@endcomponent

Thanks,<br>{{ config('app.name') }}
@endcomponent
