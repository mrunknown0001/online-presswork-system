@extends('layouts.app')

@section('title') View Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>View Article</h3>
		<p>
			<a href="{{ route('eic.article.management') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>

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
			<p>Section Editor: <strong>{{ ucwords($article->se->firstname . ' ' . $article->se->lastname) }}</strong> - {{ date('l, F j, Y g:i:s a', strtotime($article->se_proofread_date)) }}</p>
			<p>Section: <strong>{{ ucwords($article->section->name) }}</strong></p>
			<form action="{{ route('eic.approve.article') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $article->id }}">
				<div class="form-group">
					<label>Article Title</label>
					<input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control" placeholder="Article Title" required>
				</div>
				<div class="form-group">
					<label>Article Content</label>
					<textarea name="content" id="summernote" class="form-control" placeholder="Enter Article Conent" rows="10" required>{{ $article->content }}</textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-success">Approve Article</button>
					<button class="btn btn-warning" data-toggle="modal" data-target="#denyArticle">Deny Article</button>
					<a href="{{ route('eic.article.management') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
			
		</div>


	</div>

</div>
@include('eic.includes.modal-article-deny')
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});

$('#summernote').summernote('disable');
</script>
@endsection