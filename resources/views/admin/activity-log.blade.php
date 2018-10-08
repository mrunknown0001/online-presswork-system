@extends('layouts.app')

@section('title') Activity Log @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Activity Log <small>Audit Trail</small></h3>
		@if(count($logs) > 0)
			<div class="col-md-12">
				<table class="table table-hover table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">User</th>
							<th class="text-center">User Type</th>
							<th class="text-center">Action</th>
							<th class="text-center">Date &amp; Time</th>
						</tr>
					</thead>
					<tbody>
						@foreach($logs as $l)
						<tr>
							<td class="text-center">
								{{ ucwords($l->user->firstname . ' ' . $l->user->lastname) }}
							</td>
							<td class="text-center">
								@if($l->user_type == 1)
									Admin
								@elseif($l->user_type == 2)
									Editor In Chief
								@elseif($l->user_type == 2)
									Layout Editor						
								@elseif($l->user_type == 2)
									Section Editor						
								@elseif($l->user_type == 2)
									Correspondent
								@else
									Unknown
								@endif

							</td>
							<td class="text-center">
								{{ $l->action }}
							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($l->created_at)) }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">{{ $logs->links() }}</div>
			</div>
		@else		
		<p class="text-center">No Activity Found!</p>
		@endif		
	</div>

</div>
@endsection