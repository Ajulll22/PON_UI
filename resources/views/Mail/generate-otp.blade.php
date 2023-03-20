@extends('Mail.template')

@section('email_content')
<tr>
	<td>
		<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 20px; font-weight: bold;">Dear {{ $user_fullname }},</p>	
		<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 16px; font-weight: bold;">Welcome to {{ config('constants.app_name') }}</p>
	</td>
</tr>									
<tr>
	<td>
		<p>Please use the following OTP Code to continue the login process:</p>
		<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 20px; font-weight: bold">{{ $otp_code }}<p>
		<p>For your account security, please <strong style="font-weight: bold">don't share your OTP code</strong> to anyone even with Wirecard Support Team.</p>
	</td>
</tr>
@endsection