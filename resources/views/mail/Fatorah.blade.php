@component('mail::message')
# Payment Confirmation

Thank you again for choosing Innovations . Our best-in-class solutions
are designed to meet all of your online needs. Your payment has been
confirmed and you're all set to go. Log in to your account here .

@component('mail::panel')


    @component('mail::table')
        |Name|Eamil|Phone|Date|
        |:-------------:|:-------------:|
        |{{$user['Data']['CustomerName']}}|{{$user['Data']['CustomerEmail']}}|{{$user['Data']['CustomerMobile']}}|{{$user['Data']['CreatedDate']}}|
    @endcomponent


@endcomponent

@component('mail::panel')


    @component('mail::table')
        |Payment Method|Status|Invoice Number|Date|
        |:-------------:|:-------------:|:--------:|:--------:|
        |{{$user['Data']['InvoiceTransactions'][0]['PaymentGateway']}}|@SADASGF|{{$user['Data']['InvoiceId']}}|RER|
    @endcomponent


@endcomponent
@component('mail::button', ['url' => 'https://www.facebook.com/InnovationSocialmediaAgency/'])
    Facebook
@endcomponent
@component('mail::button', ['url' => 'https://www.youtube.com/channel/UCxD5aA4wJj-pt1lTkUK1SBw/featured'])
    youtube
@endcomponent
@component('mail::button', ['url' => 'https://www.instagram.com/innovationmediapro/'])
    Instagram
@endcomponent
@component('mail::button', ['url' => 'https://twitter.com/InnovationAgen4'])
    Twitter
@endcomponent

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
@endcomponent
