@extends('layouts.app')

@section('title') Article Management @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Article Management</h3>
		<p>
			<a href="{{ route('eic.approved.articles') }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View Approved Articles</a>
			<a href="{{ route('eic.view.denied.article') }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> View Denied Articles</a>
		</p>

		@include('includes.all')

		@if(count($articles) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Correspondent</th>
						<th class="text-center">Section Editor</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td class="text-center">{{ ucwords($a->title) }}</td>
							<td class="text-center">
								{{ ucwords($a->user->firstname . ' ' . $a->user->lastname) }}
							</td>
							<td class="text-center">{{ ucwords($a->se->firstname . ' ' . $a->se->lastname . ' : ' . $a->se->section_assignment->section->name) }}</td>
							<td class="text-center">
								<a href="{{ route('eic.view.article', ['id' => $a->id]) }}" class="btn btn-primary btn-xs">View</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>	
		
			<div class="text-center">
				{{ $articles->links() }}
			</div>
		@else
			<p class="text-center">No Articles to approve.</p>
		@endif
	
	</div>

</div>
@endsection