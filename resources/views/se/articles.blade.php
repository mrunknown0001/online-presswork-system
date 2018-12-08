@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Articles: {{ ucwords($sa->name) }} Section Only</h3>

		<p>
			<a href="{{ route('se.approved.articles') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View Approved Articles</a>
			<a href="{{ route('se.view.denied.article') }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> View Denied Articles</a>
		</p>
		
		@include('includes.all')

		@if(count($articles) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Correspondent</th>
						<th class="text-center">Publication</th>
						<th class="text-center">Section</th>
						<th class="text-center">Version</th>
						<th class="text-center">Date &amp; Time Submitted</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td class="text-center">
								<a href="{{ route('se.view.edit.article', ['id' => $a->id]) }}">{{ ucwords($a->title) }}</a>
							</td>
							<td class="text-center">
								{{ ucwords($a->user->firstname . ' ' . $a->user->lastname) }}
							</td>
							<td class="text-center">
								{{ $a->publication->name }}
							</td>
							<td class="text-center">
								{{ $a->section->name }}
							</td>
							<td class="text-center">
								{{  number_format((float)$a->version->version, 1, '.', '') }}
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
			<p class="text-center">No Article to Review/Approve.</p>
		@endif
	</div>
</div>
@endsection