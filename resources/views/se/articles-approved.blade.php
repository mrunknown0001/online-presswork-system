@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Approved Articles</h3>
		<p>
			<a href="{{ route('se.articles') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>
		
		@include('includes.all')

		@if(count($articles) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Correspondent</th>
						<th class="text-center">Version</th>
						<th class="text-center">Approved</th>
						<th class="text-center">Submitted</th>
						<th class="text-center">Download</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td class="text-center">
								<a href="{{ route('se.view.only.article', ['id' => $a->id]) }}">{{ ucwords($a->title) }}</a>
							</td>
							<td class="text-center">
								{{ ucwords($a->user->firstname . ' ' . $a->user->lastname) }}
							</td>
							<td class="text-center">
								{{  number_format((float)$a->version->version, 1, '.', '') }}
							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($a->se_proofread_date)) }}
							</td>
							
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($a->created_at)) }}
							</td>
							<td class="text-center">
								<a href="{{ route('se.download.article', ['id' => $a->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $articles->links() }}
			</div>
		@else
			<p class="text-center">No approved article yet.</p>
		@endif
	</div>
</div>
@endsection