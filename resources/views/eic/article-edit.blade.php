@extends('layouts.app2')

@section('title') View Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		{{-- <h3>View Article</h3> --}}
		<p>
			<a href="{{ route('eic.article.management') }}" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Back to Articles</a>
		</p>

			{{-- <p>Correspondent: <strong>{{ ucwords($article->user->firstname . ' ' . $article->user->lastname) }}</strong> - {{ date('l, F j, Y g:i:s a', strtotime($article->created_at)) }}</p> --}}
			<p>Article: <strong>{{ $article->title }}</strong> &nbsp; Section Editor: <strong>{{ ucwords($article->se->firstname . ' ' . $article->se->lastname) }}</strong> - {{ date('l, F j, Y g:i:s a', strtotime($article->se_proofread_date)) }}</p>
			{{-- <p>Section: <strong>{{ ucwords($article->section->name) }}</strong></p> --}}
			@include('includes.all')
	</div>
	<div class="col-md-3">
			<form action="{{ route('eic.approve.article') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $article->id }}">

					{{-- <label>Article Content</label> --}}
					<textarea name="content" id="" class="form-control" style="display: none;" placeholder="Enter Article Conent" rows="10" required>{{ $article->content }}</textarea>

				<div class="form-group">
					<button id="clear" type="button" class="btn btn-info btn-xs" style="display: none;"></button>
					<button type="button" id="save" class="btn btn-primary btn-xs">Save</button>
					<button class="btn btn-success btn-xs">Approve Article</button>
					<button class="btn btn-warning btn-xs" style="display: none;" data-toggle="modal" data-target="#denyArticle">Deny Article</button>
					<a href="{{ route('eic.article.management') }}" class="btn btn-danger btn-xs">Cancel</a>
				</div>
			</form>

			<div class="brushes"></div>		

	</div>
	<div class="col-md-2">
		<div class="colors">
			<strong>Colors:</strong>
			<button type="button" value="#ff0000"></button>
	    <button type="button" value="#000000"></button>
		</div>				
	</div>

  <div class="col-md-12">
    <div style="max-height: 800px;overflow: scroll;">
     <canvas id="drawing" width="1250" height="800" style="cursor: crosshair;"></canvas>
		</div>   
			
	</div>

</div>
@include('eic.includes.modal-article-deny')
<script>
$(document).ready(function() {
  $('#summernote').summernote();

  var article = "{!! $article->content !!}";

  		function wrapText(context, text, x, y, maxWidth, lineHeight) {
        var words = text.split(' ');
        var line = '';

        for(var n = 0; n < words.length; n++) {
          var testLine = line + words[n] + ' ';
          var metrics = context.measureText(testLine);
          var testWidth = metrics.width;
          if (testWidth > maxWidth && n > 0) {
            context.fillText(line, x, y);
            line = words[n] + ' ';
            y += lineHeight;
          }
          else {
            line = testLine;
          }
        }
        context.fillText(line, x, y);
      }
      
      var canvas = document.getElementById('drawing');
      var context = canvas.getContext('2d');
      var maxWidth = 1150;
      var lineHeight = 40;
      var x = (canvas.width - maxWidth) / 2;
      var y = 60;


      context.font = '15pt Calibri';
      context.fillStyle = '#333';

      wrapText(context, article, x, y, maxWidth, lineHeight);


			  var boundings = canvas.getBoundingClientRect();

			  // Specifications
			  var mouseX = 0;
			  var mouseY = 0;
			  context.strokeStyle = 'black'; // initial brush color
			  context.lineWidth = 1; // initial brush width
			  var isDrawing = false;


			  // Handle Colors
			  var colors = document.getElementsByClassName('colors')[0];

			  colors.addEventListener('click', function(event) {
			    context.strokeStyle = event.target.value || 'black';
			  });

			  // Handle Brushes
			  var brushes = document.getElementsByClassName('brushes')[0];

			  brushes.addEventListener('click', function(event) {
			    context.lineWidth = event.target.value || 1;
			  });

			  // Mouse Down Event
			  canvas.addEventListener('mousedown', function(event) {
			    setMouseCoordinates(event);
			    isDrawing = true;

			    // Start Drawing
			    context.beginPath();
			    context.moveTo(mouseX, mouseY);
			  });

			  // Mouse Move Event
			  canvas.addEventListener('mousemove', function(event) {
			    setMouseCoordinates(event);

			    if(isDrawing){
			      context.lineTo(mouseX, mouseY);
			      context.stroke();
			    }
			  });

			  // Mouse Up Event
			  canvas.addEventListener('mouseup', function(event) {
			    setMouseCoordinates(event);
			    isDrawing = false;
			  });

			  // Handle Mouse Coordinates
			  function setMouseCoordinates(event) {
			    mouseX = event.clientX - boundings.left;
			    mouseY = event.clientY - boundings.top;
			  }

			  // Handle Clear Button
			  var clearButton = document.getElementById('clear');

			  clearButton.addEventListener('click', function() {
			    context.clearRect(0, 0, canvas.width, canvas.height);
			  });

			var saveButton = document.getElementById('save');

			saveButton.addEventListener('click', function () {
				// alert('You click save button')
				// console.log('you click save button')
			    var dataURL = canvas.toDataURL();
			    // console.log(dataURL);

					$.ajax({
					  type: "POST",
					  url: "{{ route('eic.save.image.canvas') }}",
					  data: {
					     "_token": "{{ csrf_token() }}",
					     "article_id": "{{ $article->id }}",
					     imgBase64: dataURL
					  }
					}).done(function(o) {
					  console.log('saved'); 
					  alert('Proofread Article Saved!');
					  window.location.href = "{{ route('eic.article.management') }}";
					});
			});
});

// $('#summernote').summernote('disable');
</script>
@endsection