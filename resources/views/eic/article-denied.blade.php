@extends('layouts.app')

@section('title') Denied Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Denied Article</h3>
		<p>
			<a href="{{ route('eic.article.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>

		@include('includes.all')

		@if(count($articles) > 0)
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th class="text-center">Article Title</th>
						<th class="text-center">Denied Date</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($articles as $a)
						<tr>
							<td class="text-center">{{ ucwords($a->title) }}</td>
							<td class="text-center">
								{{ $a->eic_deny_date }}
							</td>
							<td class="text-center">
								@if($a->se_comply == 0)
								<span class="label label-default">Pending</span>
								@else
								<a href="{{ route('eic.view.update.article', ['id' => $a->id]) }}" class="btn btn-primary btn-xs">View</a>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>	
		
			<div class="text-center">
				{{ $articles->links() }}
			</div>
		@else
			<p class="text-center">No Denied Articles.</p>
		@endif
	
	</div>

</div>
@endsection