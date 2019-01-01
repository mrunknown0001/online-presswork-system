@extends('layouts.app')

@section('title') Article Versions @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Article Versions</h3>

		<p><a href="{{ route('se.articles') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Articles</a></p>
		
		@include('includes.all')

		@if(count($article->versionContents) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Correspondent</th>
						<th class="text-center">Publication</th>
						<th class="text-center">Section</th>
						<th class="text-center">Version</th>
						<th class="text-center">Date &amp; Time Submitted</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($article->versionContents as $a)
						<tr>
							<td class="text-center">
								{{ ucwords($article->title) }}
							</td>
							<td class="text-center">
								{{ ucwords($article->user->firstname . ' ' . $article->user->lastname) }}
							</td>
							<td class="text-center">
								{{ $article->publication->name }}
							</td>
							<td class="text-center">
								{{ $article->section->name }}
							</td>
							<td class="text-center">
								{{  number_format((float)$a->version, 1, '.', '') }}
							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($article->created_at)) }}
							</td>
							<td class="text-center">
								<a href="{{ route('se.article.version.content', ['id' => $a->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>View Content</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Article Versions.</p>
		@endif
	</div>
</div>
@endsection