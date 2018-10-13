@extends('layouts.app')

@section('title') Denied Layout @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Denied Layout</h3>
		<p>
			<a href="{{ route('le.layouts.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Layouts Management</a>
		</p>

		@if(count($layouts) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Filename</th>
						<th class="text-center">Date Submitted</th>
						<th class="text-center">Date Denied</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($layouts as $l)
						<tr>
							<td class="text-center">{{ $l->filename }}</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($l->created_at)) }}
							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($l->denied_date)) }}
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-xs">Action</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Layouts Denied!</p>
		@endif

	</div>
</div>
@endsection