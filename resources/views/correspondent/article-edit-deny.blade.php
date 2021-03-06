@extends('layouts.app')

@section('title') Update Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12 panel-info">
		<h3>Update Article</h3>

		<div class="content-box-header panel-heading">
			<div class="panel-title">Update Article Form</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			
			<label>Comment</label>
			<div class="">
				{{-- <p>{{  ucwords($article->se_comment) }}</p> --}}
				<p>
					@if(!empty($article->proofread))
						<a href="{{ route('se.article.download.proofreade', ['id' => $article->proofread->id]) }}" class="btn btn-primary">View &amp; Download Proofread Article</a>
					@endif
				</p>
			</div>

			<form action="{{ route('correspondent.update.article.post') }}" method="POST" autocomplete="off">
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
					<button class="btn btn-success">Update &amp; Submit Article</button>
					<a href="{{ route('correspondent.articles') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
			
		</div>
		
	</div>
</div>

<script>
	$(document).ready(function() {
	  $('#summernote').summernote();
	});

  $('#summernote').summernote({
    placeholder: 'Enter Article Content',
    tabsize: 2,
    height: 100,
    disableDragAndDrop: true,
   	toolbar: [
	    // [groupName, [list of button]]
	    ['style', ['bold', 'italic', 'underline', 'clear']],
	    ['font', ['strikethrough', 'superscript', 'subscript']],
	    ['fontsize', ['fontsize']],
	    ['color', ['color']],
	    ['para', ['ul', 'ol', 'paragraph']],
	    ['height', ['height']],
	    ['fullscreen']
	],
	fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']
  });

  </script>
@endsection