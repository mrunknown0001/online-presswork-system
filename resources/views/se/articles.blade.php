@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Articles: {{ ucwords($sa->name) }} Section Only</h3>
		
		@include('includes.all')

		@if(count($articles) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Correspondent</th>
						<th class="text-center">Date &amp; Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td class="">{{ ucwords($a->title) }}</td>
							<td class="text-center">
								{{ ucwords($a->user->firstname . ' ' . $a->user->lastname) }}
							</td>
							<td class="text-center">
								{{ $a->created_at }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center"></p>
		@endif
	</div>
</div>
@endsection