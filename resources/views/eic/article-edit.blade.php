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
	<div class="col-md-5">
			<form action="{{ route('eic.approve.article') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $article->id }}">

					{{-- <label>Article Content</label> --}}
					<textarea name="content" id="" class="form-control" style="display: none;" placeholder="Enter Article Conent" rows="10" required>{{ $article->content }}</textarea>

				<div class="form-group">
					<button id="clear" type="button" class="btn btn-info btn-xs" style="display: none;"></button>
					<button id="save" type="button" class="btn btn-primary btn-xs"><i class="fa fa-save"></i> Save</button>
					<button class="btn btn-success btn-xs">Approve Article</button>
					<button class="btn btn-warning btn-xs" style="display: none;" data-toggle="modal" data-target="#denyArticle">Deny Article</button>
					<a href="{{ route('eic.article.management') }}" class="btn btn-danger btn-xs"><i class="fa fa-times-rectangle"></i> Cancel</a>
					<span class="btn btn-warning btn-xs" id="undo"><i class="fa fa-undo"></i> Undo</span>  
					<span class="btn btn-info btn-xs" id="redo"><i class="fa fa-refresh"></i> Redo</span>
					<span class="btn btn-default btn-xs" id="pencil"><i class="fa fa-pencil"></i> Write</span>
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
  var parse1 = $($.parseHTML(article)).html();
  var parsedArticle = $($.parseHTML(article)).html();

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
// 
// start of new added code
(function($) {
  var tool;
  var canvas = $('drawing');
  // var canvas = document.getElementById('drawing');
  var ctx = canvas.getContext('2d');
  
  var history = {
    redo_list: [],
    undo_list: [],
    saveState: function(canvas, list, keep_redo) {
      keep_redo = keep_redo || false;
      if(!keep_redo) {
        this.redo_list = [];
      }
      
      (list || this.undo_list).push(canvas.toDataURL());   
    },
    undo: function(canvas, ctx) {
      this.restoreState(canvas, ctx, this.undo_list, this.redo_list);
    },
    redo: function(canvas, ctx) {
      this.restoreState(canvas, ctx, this.redo_list, this.undo_list);
    },
    restoreState: function(canvas, ctx,  pop, push) {
      if(pop.length) {
        this.saveState(canvas, push, true);
        var restore_state = pop.pop();
        var img = new Element('img', {'src':restore_state});
        img.onload = function() {
          ctx.clearRect(0, 0, 1250, 800);
          ctx.drawImage(img, 0, 0, 1250, 800, 0, 0, 1250, 800);  
        }
      }
    }
  }
  
  var pencil = {
    options: {
      stroke_color: ['00', '00', '00'],
      dim: 4
    },
    init: function(canvas, ctx) {
      this.canvas = canvas;
      this.canvas_coords = this.canvas.getCoordinates();
      this.ctx = ctx;
      this.ctx.strokeColor = this.options.stroke_color;
      this.drawing = false;
      this.addCanvasEvents();
    },
    addCanvasEvents: function() {
      this.canvas.addEvent('mousedown', this.start.bind(this));
      this.canvas.addEvent('mousemove', this.stroke.bind(this));
      this.canvas.addEvent('mouseup', this.stop.bind(this));
      this.canvas.addEvent('mouseout', this.stop.bind(this));
    },
    start: function(evt) {
      var x = evt.page.x - this.canvas_coords.left;
      var y = evt.page.y - this.canvas_coords.top;
      this.ctx.beginPath();
      this.ctx.moveTo(x, y);
      history.saveState(this.canvas);
      this.drawing = true;
    },
    stroke: function(evt) {
      if(this.drawing) {
        var x = evt.page.x - this.canvas_coords.left;
        var y = evt.page.y - this.canvas_coords.top;
        this.ctx.lineTo(x, y);
        this.ctx.stroke();
        
      }
    },
    stop: function(evt) {
      if(this.drawing) this.drawing = false;
    }
  };
  
  $('pencil').addEvent('click', function() {
    pencil.init(canvas, ctx);
  });
  
  $('undo').addEvent('click', function() {
    history.undo(canvas, ctx);
  });
  
  $('redo').addEvent('click', function() {
    history.redo(canvas, ctx);
  });

  
})(document.id)



$(function() {
    $('#pencil').click();
});

// end of new added code
</script>
@endsection