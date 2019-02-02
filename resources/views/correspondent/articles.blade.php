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
		
		@if(count($articles) > 0)
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Publication</th>
						<th class="text-center">Section</th>
						<th class="text-center">Status</th>
						<th class="text-center">Version</th>
						<th class="text-center">Date &amp; Time Submitted</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td class="text-center"><a href="{{ route('correspondent.view.article', ['id' => $a->id]) }}">{{ ucwords(substr($a->title, 0, 50)) }}</a>
							</td>
							<td class="text-center">
								{{ $a->publication->name }}
							</td>
							<td class="text-center">
								{{ ucwords($a->section->name) }}
							</td>
							<td class="text-center">
								@if($a->se_proofread == 1)
									<span class="label label-success">Approved</span>
								@elseif($a->se_deny == 1)
									<span class="label label-warning">Denied</span>
									<a href="{{ route('correspondent.edit.deny.article', ['id' => $a->id]) }}">Edit</a>
								@else
									<span class="label label-default">Pending</span>
								@endif
							</td>
							<td class="text-center">
								{{  number_format((float)$a->version, 1, '.', '') }}
							</td>
							<td class="text-center">
								{{ date('l, F j, Y g:i:s a', strtotime($a->created_at)) }}
							</td>
							<td class="text-center">
								<a href="{{ route('correspondent.article.versions', ['id' => $a->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Verisons</a>
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