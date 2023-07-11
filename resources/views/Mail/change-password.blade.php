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
		Your {{ config('constants.app_name') }} password has been changed.
	</td>
</tr>
@endsection