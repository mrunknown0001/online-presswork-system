@extends('layouts.app')

@section('title') Denied Layout @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Denied Layout</h3>

		<p>
			<a href="{{ route('eic.layout.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Layouts</a>

		</p>

		@include('includes.all')

		@if(count($layouts) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Filename</th>
						<th class="text-center">Date Submitted</th>
						<th class="text-center">Date Denied</th>
						<th class="text-center">Status</th>
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
								{{ date('l, F j, Y g:i:s a', strtotime($l->approved_date)) }}
							</td>
							<td class="text-center">
								@if($l->le_comply == 0)
									<span class="label label-default">Pending</span>
								@else
									<span class="label label-success">Complied</span>
								@endif
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#layout-{{ $l->id }}"><i class="fa fa-eye"></i> View</button>
							</td>
						</tr>
						@include('eic.includes.modal-layout-view')
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $layouts->links() }}
			</div>
		@else
			<p class="text-center">No Layouts Submitted!</p>
		@endif

	</div>
	

</div>
@endsection