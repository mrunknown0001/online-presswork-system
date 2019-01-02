@extends('layouts.app')

@section('title') Approved Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3> Approved Articles </h3>
		<p>
			<a href="{{ route('eic.article.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>

		@include('includes.all')

		@if(count($articles) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Correspondent</th>
						<th class="text-center">Section Editor</th>
						<th class="text-center">Proofread Date</th>
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
							<td class="text-center">{{ ucwords($a->se->firstname . ' ' . $a->se->lastname) }}</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($a->eic_proofread_date)) }}
							</td>
							<td class="text-center">
								<a href="{{ route('eic.download.article', ['id' => $a]) }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> Download</a> <a href="" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Versions</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>	
		
			<div class="text-center">
				{{ $articles->links() }}
			</div>
		@else
			<p class="text-center">No Approve Articles.</p>
		@endif
	
	</div>

</div>
@endsection