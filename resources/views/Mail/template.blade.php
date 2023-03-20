<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Prima vista Solusi - {{ config('constants.app_name') }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
	    <!-- vendor css -->
		<style>
		body {
			font-family: Helvetica;
			font-size: 14px;
		}
		.responsive {
		  max-width: 100%;
		  height: auto;
		}
		.footer-line {
			border-bottom: 8px solid #053264;
			background-color: #eeeeee;
			font-size: 11px;
			font-family: arial, Helvetica;
			padding: 0px 0px 0px 10px;
		}
		.body-email {
			background-color: #fefefe !important;
		}
		.datatable {
		  font-family: arial, Helvetica;
		  border-collapse: collapse;
		  /*width: 100%;*/
		}
		.datacell {
		  border: 1px solid #000;
		  text-align: left;
		  padding: 3px;
		}

		.btn-outline-primary {
		    color: #0866C6;
		    background-color: transparent;
		    background-image: none;
		    border-color: #0866C6;
		}

		.btn-block {
		    display: block;
		    width: 100%;
		}

		.btn {
		    font-weight: normal;
		    text-align: center;
		    white-space: nowrap;
		    vertical-align: middle;
		    user-select: none;
		    border: 1px solid transparent;
		    padding: 0.65rem 0.75rem;
		    font-size: 0.875rem;
		    line-height: 1.25;
		    border-radius: 3px;
		    transition: all 0.15s ease-in-out;
		}


		.btn-cp-wrapper{
			width: 30%;
			margin: 10px auto;
			text-align: center;
		}
		.btn-cp{
			text-decoration: none;
			display: block;
		    width: 100%;
		    color: #fff !important;
		    background-color: #0866C6;
		    border-color: #0866C6;
		    font-weight: normal;
		    text-align: center;
		    white-space: nowrap;
		    vertical-align: middle;
		    user-select: none;
		    border: 1px solid transparent;
		    padding: 0.65rem 0.75rem;
		    font-size: 0.875rem;
		    line-height: 1.25;
		    border-radius: 3px;
		    transition: all 0.15s ease-in-out;
		    margin: 20px auto;
		}
		</style>
	</head>
	<body style="margin: 0; padding: 0;">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="700">
						<!-- <tr bgcolor="#053264" style="padding: 5px;"> -->
						<tr style="padding: 5px;">
							<td style="color:white; display: inline;">
								<p style="padding: 0px 5px 0px 5px">
									<!-- Embedding An Image In An E-Mail View -->
									<!-- image size must less than 5 KB -->
									<img src="{{ asset('assets/img/pvs-lg-blue.png') }}" alt="PVS" align="right" class="responsive" width="120" height="25"/>
									<!-- <div style="color:#053264;font-size: 14px; font-family: Helvetica;padding-left: 10px; font-weight: bold;" align="right">Wirecard File Management System</div> -->
								</p>						
							</td>
						</tr>								
						<tr style="padding-bottom:30px; ">
							<td class="body-email" style="padding: 20px 30px 40px 30px;">
								<table border="0" cellpadding="0" cellspacing="0" width="100%">
									<!-- E-Mail Content  -->	
									@yield('email_content')
									<!-- /E-Mail Content -->		
									<tr>
										<td>
											<p>If you have any inquiry, do not hesitate to contact us.</p>
										</td>
									</tr>																
									<tr>
										<td>
										   <p>Thank You,<br>{{ config('constants.app_name') }}</p>
										 </td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<p class="footer-line"><b>CONFIDENTIAL!</b><br>
								This email contains confidential information and is intended for the authorised recipient only. If you are not an authorised recipient, please return the email to us and then delete it from your computer and mail server. You may neither use nor edit any such emails including attachments, nor make them accessible to third parties in any manner whatsoever. Thank you for your cooperation. 
								</p>
							</td>
						</tr>						
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>