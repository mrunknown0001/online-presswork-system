@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Articles</h3>
		<p>
			<a href="{{ route('correspondent.new.article') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-asterisk"></i> New Article</a>
			
		</p>

		@include('includes.all')
		<hr>
		@if(count($articles) > 0)
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Date &amp; Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td><a href="{{ route('correspondent.view.article', ['id' => $a->id]) }}">{{ ucwords(substr($a->title, 0, 50)) }}</a>
							</td>
							<td class="text-center">
								{{ $a->created_at }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $articles->links() }}
			</div>
		@else
			<p class="text-center">You have not yet submitted any article.</p>
		@endif

	</div>
</div>
@endsection