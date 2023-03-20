@extends('Mail.template')

@section('email_content')
	<tr>
		<td>
			<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 20px; font-weight: bold;">Dear {{ $user_name }},</p>	
			<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 16px; font-weight: bold;">Welcome to {{ config('constants.app_name') }}</p>
		</td>
	</tr>
	<tr style="color: #000000">
		<td>
			<p>You are receiving this email because we received a reset password request for your {{ config('constants.app_name') }} account.</p>
			<p>You can ignore this email if you did not make any reset password request.</p>
	</tr>
	<tr style="color: #000000">
		<td>	
			Here is your new password for {{ config('constants.app_name') }} :
		</td>
	</tr>
	<tr>
		<td style="padding: 10px 0 30px 0;">
		 <table>
			<tr style="font-weight: bold;">
				<td>Email</td>
				<td>: {{ $user_email }}</td>
			</tr>
			<tr style="font-weight: bold;">
				<td>Password</td>
				<td>: {{ $user_password }}</td>
			</tr>																		
		</table>										
		</td>
	</tr>
@endsection