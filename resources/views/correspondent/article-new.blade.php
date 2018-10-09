@extends('layouts.app')

@section('title') New Article @endsection

@section('content')
<div class="row">
	<div class="col-md-12 panel-info">
		<h3>New Article</h3>

		<div class="content-box-header panel-heading">
			<div class="panel-title">Add New Article Form</div>
		
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
					<label>Select Section</label>
					<select name="section" id="section" class="form-control" required>
						<option>Select Section</option>
						@if(count($sections) > 0)
							@foreach($sections as $s)
							<option value="{{ $s->id }}">{{ ucwords($s->name) }}</option>
							@endforeach
						@else
						<option value="">No Section Found</option>
						@endif
					</select>
				</div>
				<div class="form-group">
					<label>Article Title</label>
					<input type="text" name="title" id="title" class="form-control" placeholder="Article Title" required>
				</div>
				<div class="form-group">
					<label>Article Content</label>
					<textarea name="content" id="content" class="form-control" placeholder="Enter Article Conent" rows="10" required></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-success">Submit Article</button>
					<a href="{{ route('correspondent.articles') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
			
		</div>
		
	</div>
</div>
@endsection