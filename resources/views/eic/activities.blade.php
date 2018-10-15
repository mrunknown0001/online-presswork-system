@extends('layouts.app')

@section('title') Activities @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Activities</h3>
		<p>
			<a href="{{ route('eic.add.activity') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Activity</a>
			<a href="{{ route('eic.history.activity') }}" class="btn btn-info btn-sm"><i class="fa fa-history"></i> Activity History</a>

		</p>

		@include('includes.all')

		@if(count($activities) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Title</th>
						<th class="text-center">Start Date</th>
						<th class="text-center">End Date</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($activities as $a)
						<tr>
							<td class="text-center">
								{{ ucwords($a->title) }}
							</td>
							<td class="text-center">
								{{ date('F j, Y', strtotime($a->start_date)) }}
							</td>
							<td class="text-center">
								{{ date('F j, Y', strtotime($a->end_date)) }}
							</td>
							<td class="text-center">
								<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deactivateActivity-{{ $a->id }}">Deactivate</button>
							</td>
						</tr>
						@include('eic.includes.modal-activity-deactivate')
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $activities->links() }}
			</div>
		@else
			<p class="text-center">No Active Activity!</p>
		@endif
	</div>
</div>
@endsection