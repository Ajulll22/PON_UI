@extends('Mail.template')

@section('email_content')
<tr>
	<td>
		<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 20px; font-weight: bold;">Dear {{ $user_name }},</p>	
		<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 16px; font-weight: bold;">Welcome to {{ config('constants.app_name') }}</p>
	</td>
</tr>									
<tr>
	<td>	
		Your {{ config('constants.app_name') }} password has been changed. You can sign in to {{ config('constants.app_name') }} using the following username and password:
	</td>
</tr>
<tr>
	<td style="padding: 10px 0 30px 0;">
	 <table>
		<tr style="font-weight: bold;">
			<td>Username</td>
			<td>: {{ $user_name }}</td>
		</tr>
		<tr style="font-weight: bold;">
			<td>Password</td>
			<td>: {{ $user_password }}</td>
		</tr>
	</table>										
	</td>
</tr>
@endsection