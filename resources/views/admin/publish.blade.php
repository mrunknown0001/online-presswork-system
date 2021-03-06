@extends('layouts.app')

@section('title') Publish @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Publish Approval</h3>

		<p>
			<a href="{{ route('admin.approved.layout.publish') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View Approved</a>
			<a href="{{ route('admin.denied.layout.publish') }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> View Denied</a>
			
		</p>

		@include('includes.all')

		@if(count($layouts) > 0)
			<table class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th class="text-center">Filename</th>
						<th class="text-center">Date Submitted</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($layouts as $l)
						<tr>
							<td class="text-center">
								{{ $l->filename }}
							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($l->created_at)) }}
							</td>
							<td class="text-center">
								<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#layout-{{ $l->id }}">View</button>
							</td>
						</tr>
						@include('admin.includes.modal-layout-view')
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $layouts->links() }}
			</div>
		@else
			<p class="text-center">No Layouts to Approved.</p>
		@endif

	</div>

</div>
@endsection