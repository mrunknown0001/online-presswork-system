@extends('layouts.app')

@section('title') Article Versions @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Article Versions</h3>
		<p>
			<a href="{{ route('correspondent.articles') }}" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-arrow-left"></i> Articles</a>
			
		</p>

		@include('includes.all')
		
		@if(!empty($article->version))
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
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
								{{ ucwords(substr($article->title, 0, 50)) }}
							</td>
							<td class="text-center">
								{{ $article->publication->name }}
							</td>
							<td class="text-center">
								{{ ucwords($article->section->name) }}
							</td>
							<td class="text-center">
								{{  number_format((float)$a->version, 1, '.', '') }}

							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($a->created_at)) }}
							</td>
							<td class="text-center">
								<a href="{{ route('correspondent.article.version.content.view', ['id' => $a->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Content</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Version For This Article</p>
		@endif

	</div>
</div>
@endsection