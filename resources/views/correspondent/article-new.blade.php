@extends('layouts.app')

@section('title') New Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12 panel-info">
		<h3>New Article</h3>

		<div class="content-box-header panel-heading">
			<div class="panel-title">Add New Article Form </div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')

			<form action="{{ route('correspondent.new.article.post') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Select Publication</label>
					<select name="publication" id="publication" class="form-control">
						<option value="">Select Publication</option>
						@foreach($publications as $p)
							<option value="{{ $p->id }}">{{ $p->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Select Section</label>
					<select name="section" id="section" class="form-control" required>
						<option>Select Section</option>
					</select>
				</div>
				<div class="form-group">
					<label>Article Title</label>
					<input type="text" name="title" id="title" class="form-control" placeholder="Article Title" required>
				</div>
				<div class="form-group">
					<label>Article Content</label>
					<textarea name="content" id="summernote" class="form-control" placeholder="Enter Article Conent" rows="10" required></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-success">Submit Article</button>
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

  // get open publication section 
	$("#publication").change(function () {

		var publicationId = $("#publication").val();

		$('#section')
		    .empty()
		    .append('<option selected="selected" value="">Select Section</option>')
		;

		$.ajax({url: "/correspondent/publication/" + publicationId, success: function(result){
	     Object.keys(result).forEach(function(key) {

			  $('#section').append('<option value="' + result[key].id + '">' + result[key].name + '</option>');
			  
			});
	  }});

	});

</script>
@endsection