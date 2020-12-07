@extends('mails/app')
@section('body')
	<tr>
		<td>
			<h1 style="color: #231f20;padding-top: 30px;font-family: 'Open Sans',sans-serif;font-size: 36px;">
				Verify your email address
			</h1>
		</td>
	</tr>

	<tr>
		<td>
			<p style="color:#333333;padding-top: 0;padding-right: 60px;padding-bottom: 5px;padding-left: 60px;font-family: 'Open Sans',sans-serif;">
				Please validate your email by clicking the following link. You will be redirected to our site.
			</p>
		</td>
	</tr>

	<tr>
		<td style="padding-bottom: 40px;padding-top: 30px;">
			<a href="{{$link}}" target="_blank" style="overflow: hidden; clear: both; display: inline-block; border: 2px solid #007bff; border-radius: 3px; padding: 10px 15px; text-decoration: none; color: #007bff;">
				Complete registration
			</a>
		</td>
	</tr>

	
@stop