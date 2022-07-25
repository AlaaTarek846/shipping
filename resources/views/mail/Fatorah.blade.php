@component('mail::message')
    # Payment Confirmation

    Thank you again for choosing Innovations . Our best-in-class solutions
    are designed to meet all of your online needs. Your payment has been
    confirmed and you're all set to go. Log in to your account here .

    @component('mail::panel')

        @component('mail::table')
            |Name|Eamil|Phone|
            |:-------------:|:-------------:|:-------------:|
            |{{$user['user_data']['name']}}|{{$user->email}}|{{$user->phone_number}}|
        @endcomponent

    @endcomponent

    @component('mail::panel')

        @component('mail::table')
            |Packge name|Duration|Price|Expiry Date|
            |:-------------:|:-------------:|:--------:|:--------:|
            |{{$user['package']['name']}}|{{$user['package']['count_months']}}{{$user['package']['duration']}}|{{$user['package']['price']}}|{{$user['package_date']}}|
        @endcomponent
    @endcomponent

    @component('mail::panel')

        @component('mail::table')
            |Date|Total|
            |:-------------:|:-------------:|
            |{{now()->format('Y-m-d')}}|{{$user['package']['price']}}|
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
