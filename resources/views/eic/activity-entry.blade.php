@extends('layouts.app')

@section('title') Activity Entries @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Activity Entries</h3>
		<p>
			<a href="{{ route('eic.activities') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Activities</a>
		</p>

		@include('includes.all')
		<h3>Activity Title: {{ ucwords($activity->title) }}</h3>
		@if(count($entries) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center">Filename</th>
						<th class="text-center">Date Submitted</th>
						<th class="text-center">Downloaded</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($entries as $e)
						<tr>
							<td class="text-center">{{ $e->firstname != null || $e->lastname != null ? ucwords($e->firstname . ' ' . $e->lastname) : 'Anonymous' }}</td>
							<td class="text-center">{{ $e->filename }}</td>
							<td class="text-center">{{ date('l, F j, Y g:i:s a', strtotime($e->created_at)) }}</td>
							<td class="text-center">{{ $e->downloaded == 1 ? 'Yes' : 'No' }}</td>
							<td class="text-center">
								<a href="{{ route('eic.download.activity.entry', ['a_id' => $activity->id, 'e_id' => $e->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i></a>
								<a href="{{ route('eic.send.mail.activity.entry', ['id' => $activity->id, 'eic' => $e->id]) }}" class="btn btn-success btn-xs"><i class="fa fa-send"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Entries Found!</p>
		@endif

	</div>
</div>
@endsection