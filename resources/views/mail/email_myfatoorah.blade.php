@component('mail::message')
    # Introduction


    Thank you again for choosing Innovations . Our best-in-class solutions are designed to meet all of your online needs. Your payment has been confirmed and you're all set to go. Log in to your account here .

    @component('mail::panel')
        @component('mail::table')
            |Name|@mdo|||
            |-------------|:-------------:|--------:|--------:|
            |Address|@mdo|||
            |Eamil|Right-Aligned|Phone|011136674|
            |Payment Method|Right-Aligned|Status|Paid|
            |Invoice Number|Right-Aligned|Date|20/2/2022|
        @endcomponent
    @endcomponent


    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent

