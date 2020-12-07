@extends('mails/app')
@section('body')
	<tr>
		<td>
			<h1 style="color: #231f20;padding-top: 30px;font-family: 'Open Sans',sans-serif;font-size: 36px;">
				Invitation
			</h1>
		</td>
	</tr>

	<tr>
		<td>
			<p style="color:#333333;padding-top: 0;padding-right: 60px;padding-bottom: 5px;padding-left: 60px;font-family: 'Open Sans',sans-serif;">
				Please confirm your attendance to the event <strong style="color:#007bff;font-family: 'Open Sans',sans-serif;">{{$event}}</strong> by clicking on the confirmation button below
			</p>
		</td>
	</tr>

	<tr>
		<td style="padding-bottom: 40px;padding-top: 30px;">
			<a href="{{$link}}" target="_blank" style="overflow: hidden; clear: both; display: inline-block; border: 2px solid #007bff; border-radius: 3px; padding: 10px 15px; text-decoration: none; color: #007bff;">
				Confirm Attendance
			</a>
		</td>
	</tr>

@stop