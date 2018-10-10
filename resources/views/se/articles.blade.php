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
						<th class="text-center">Date &amp; Time Submitted</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td class="text-center">
								<a href="{{ route('se.view.article', ['id' => $a->id]) }}">{{ ucwords($a->title) }}</a>
							</td>
							<td class="text-center">
								{{ ucwords($a->user->firstname . ' ' . $a->user->lastname) }}
							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($a->created_at)) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $articles->links() }}
			</div>
		@else
			<p class="text-center"></p>
		@endif
	</div>
</div>
@endsection