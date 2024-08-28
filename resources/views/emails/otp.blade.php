@component('mail::message')

    <div style="text-align: center">
        <h2>Verification code</h2>
        <p style="font-size: 15px">Your Code is {{ $otp }} </p>
    </div>

@endcomponent
