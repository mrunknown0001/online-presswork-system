@extends('layouts.app')

@section('title') Articles @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Proofreaded Articles</h3>

		<p>
			<a href="{{ route('se.articles') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>
		
		@include('includes.all')
		
		@if(count($proofreaded) > 0)
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<th class="text-center">Article Title</th>
					<th class="text-center">File</th>
					<th class="text-center">Action</th>
				</thead>
				<tbody>
					@foreach($proofreaded as $p)
						<tr>
							<td class="text-center">
								{{ strtoupper($p->article->title) }}
							</td>
							<td class="text-center">
								{{ strtoupper($p->filename) }}
							</td>
							<td class="text-center">
								<a href="{{ route('se.article.download.proofreade', ['id' => $p->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-download"></i> Download</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center">No Parsed Article</p>
		@endif

	</div>
</div>
@endsection