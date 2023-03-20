@extends('Mail.template')

@section('email_content')
<tr>
	<td>
		<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 20px; font-weight: bold;">Dear {{ $fullname }},</p>	
		<p style="font-family: Helvetica; text-align: center; color: #053264; font-size: 16px; font-weight: bold;">Welcome to {{ config('constants.app_name') }}</p>
	</td>
</tr>									
<tr>
	<td>	
	You have registered in Wirecard {{ config('constants.app_name') }}. Please log in and change your password with the following email and password:
	</td>
</tr>
<tr>
	<td style="padding: 10px 0 30px 0;">
	 <table>
		<tr style="font-weight: bold;">
			<td>Email</td>
			<td>: {{ $email }}</td>
		</tr>
		<tr style="font-weight: bold;">
			<td>Password</td>
			<td>: {{ $password }}</td>
		</tr>																			
	</table>										
	</td>
</tr>
@endsection