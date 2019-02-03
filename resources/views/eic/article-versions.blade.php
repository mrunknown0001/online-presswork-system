@extends('layouts.app')

@section('title') Article Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Article Versions</h3>
		<p>
			<a href="{{ route('eic.article.management') }}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>

		@include('includes.all')

		@if(count($article->versionContents) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Correspondent</th>
						<th class="text-center">Section Editor</th>
						<th class="text-center">Version</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($article->versionContents as $a)
						<tr>
							<td class="text-center">{{ ucwords($a->article->title) }}</td>
							<td class="text-center">
								{{ ucwords($a->article->user->firstname . ' ' . $a->article->user->lastname) }}
							</td>
							<td class="text-center">{{ ucwords($a->article->se->firstname . ' ' . $a->article->se->lastname . ' : ' . $a->article->se->section_assignment->section->name) }}</td>
							<td class="text-center">
								{{  number_format((float)$a->version, 1, '.', '') }}
							</td>
							<td class="text-center">
								<a href="{{ route('eic.view.article.version.content', ['id' => $a->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Content</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>	
		
		@else
			<p class="text-center">No Versions.</p>
		@endif
	
	</div>

</div>
@endsection