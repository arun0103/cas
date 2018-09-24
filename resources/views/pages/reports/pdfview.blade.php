@extends('layouts.master')

@section('content')
	<style type="text/css">
		table td, table th{
			border:1px solid black;
		}
	</style>
	<div class="container">


		<br/>
		<a href="{{ route('pdfview',['download'=>'pdf']) }}">Download PDF</a>


		<table>
			<tr>
				<th>No</th>
				<th>Leave Name</th>
				<th>Approved By</th>
			</tr>
			@foreach ($leaves as $key => $leave)
			<tr>
				<td>{{ ++$key }}</td>
				<td>{{ $leave->leave_id }}</td>
				<td>{{ $leave->approved_by }}</td>
			</tr>
			@endforeach
		</table>
	</div>
@endsection