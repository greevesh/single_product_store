@component('mail::message')
Hello there,

Thank you for shopping with Nuzest. We hope you enjoy your new protein powder. 

@component('mail::button', ['url' => '/view-order'])
View Order 
@endcomponent

Thanks,<br>
Nuzest 
@endcomponent
