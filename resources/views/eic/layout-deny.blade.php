@extends('layouts.app')

@section('title') Deny Layout @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Deny Layout</h3>

		<div class="content-box-header">
			<div class="panel-title">Deny Layout Form</div>
		
			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')

			<div class="row">
				<div class="col-md-6">
					<p>File: {{ $layout->filename }}</p>
					<form action="{{ route('eic.deny.layout.post') }}" method="POST" autocomplete="off">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{ $layout->id }}">
						<div class="form-group">
							<textarea name="comment" id="comment" class="form-control" placeholder="Comment" required></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-warning">Deny Layout</button>
							<a href="{{ route('eic.layout.management') }}" class="btn btn-danger">Cancel</a>
						</div>
					</form>
				</div>
			</div>

		</div>




	</div>
</div>
@endsection