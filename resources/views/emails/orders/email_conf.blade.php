@component('mail::message')
Hello there,

This is the confirmation email we informed you about. 

Thank you for shopping with Nuzest. We hope you enjoy your new protein powder. 

@component('mail::button', ['url' => '/view-order'])
View Order 
@endcomponent

Thanks,<br>
Nuzest 
@endcomponent
