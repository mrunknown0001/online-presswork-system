@extends('layouts.app')

@section('title') View Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<p><a href="{{ route('correspondent.articles') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a></p>
		<h3>{{ ucwords($article->title) }}</h3>
		@include('includes.all')
		<div>
			<textarea class="form-control" id="summernote" name="editordata" rows="15" readonly="">{{ $article->content }}</textarea>
		</div>

	</div>
</div>
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});

$('#summernote').summernote({
	placeholder: 'View Only',
	tabsize: 2,
	height: 100
});
</script>
@endsection