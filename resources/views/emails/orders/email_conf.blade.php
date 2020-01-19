@component('mail::message')
Hello there,

This is the confirmation email we informed you about. 

Thank you for shopping with Nuzest. We hope you enjoy your new protein powder. 

<b>Your actions:</b>
<br>
Tubs ordered: {{ Cart::count() }}
<br>
Total price: £{{ Cart::total() }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
