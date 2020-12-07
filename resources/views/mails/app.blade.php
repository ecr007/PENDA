<body bgcolor="#f6f6f6" style="background-color:#f6f6f6;">
	<div bgcolor="#f6f6f6" style="background-color:#f6f6f6;padding-top: 20px;padding-bottom: 20px;">
		<table width="100%" align="center" style="max-width: 580px;background: #fff; border-collapse: collapse; border-radius: 8px; border-spacing: 0; padding: 0; table-layout: auto; font-family: 'Open Sans', sans-serif; text-align: center;">
			<tr>
				<td style="padding-top: 25px;">
					<img src="{{asset('images/gathr-logo-gr-88h@2x.png')}}" alt="logo {{env('APP_NAME')}}" width="297px" height="88px">
				</td>
			</tr>

			@yield('body')

			<tr>
				<td>
					<p style="color:#8d8d8d;font-size:12px;text-align:center;margin-bottom:20px;padding-left: 30px;padding-right: 30px;font-family: 'Open Sans',sans-serif;">
						{{date('Y')}} &copy; {{env('APP_NAME')}}. All rights reserved.
					</p>
				</td>
			</tr>
		</table>
	</div>
</body>