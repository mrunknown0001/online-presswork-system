@extends('layouts.app')

@section('title') View Article Version Content @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<p><a href="{{ route('correspondent.articles') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Articles</a></p>
		<h3>{{ ucwords($avc->article->title) }}</h3>
		<h4>Version: {{  number_format((float)$avc->version, 1, '.', '') }}</h4>

		@include('includes.all')
		<div>
			<textarea class="form-control" id="summernote" rows="15" readonly="">{{ $avc->content }}</textarea>
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