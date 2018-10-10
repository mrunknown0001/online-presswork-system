@extends('layouts.app')

@section('title') Update Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<p><a href="{{ route('se.view.denied.article') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Denied Articles</a></p>
		<h3>View Article: {{ ucwords($article->title) }}</h3>

		<div class="content-box-header panel-heading">
			<div class="panel-title">Edit Article</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			<p>Correspondent: <strong>{{ ucwords($article->user->firstname . ' ' . $article->user->lastname) }}</strong> - {{ date('l, F j, Y g:i:s a', strtotime($article->created_at)) }}</p>
			<form action="{{ route('se.update.article.post') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $article->id }}">
				<div class="form-group">
					<label>Article Title</label>
					<input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control" placeholder="Article Title" required>
				</div>
				<div class="form-group">
					<label>Article Content</label>
					<textarea name="content" id="content" class="form-control" placeholder="Enter Article Conent" rows="10" required>{{ $article->content }}</textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-success">Update &amp; Submit Article</button>
					<a href="{{ route('se.view.denied.article') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
			
		</div>
			


	</div>
</div>
@include('se.includes.modal-deny-article')
@endsection