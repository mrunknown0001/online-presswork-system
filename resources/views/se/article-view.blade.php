@extends('layouts.app')

@section('title') View Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<p><a href="{{ route('se.approved.articles') }}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Back to Approved Articles</a></p>
		<h3>View Article: {{ ucwords($article->title) }}</h3>

		<div class="content-box-header panel-heading">
			<div class="panel-title">View Article </div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			<p>Correspondent: <strong>{{ ucwords($article->user->firstname . ' ' . $article->user->lastname) }}</strong> - {{ date('l, F j, Y g:i:s a', strtotime($article->created_at)) }}</p>
			<p>Approved: <strong>{{ date('l, F j, Y g:i:s a', strtotime($article->se_proofread_date)) }}</strong></p>

			<p>Title: <strong>{{ ucwords($article->title) }}</strong></p>

			<p>Section: <strong>{{ ucwords($article->section->name) }}</strong></p>

			<div>
				<textarea class="form-control" id="summernote" rows="15" readonly="">{{ $article->content }}</textarea>
			</div>
			
		</div>
			


	</div>
</div>
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});

$('#summernote').summernote('disable');
</script>
@endsection