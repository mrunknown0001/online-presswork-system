@extends('layouts.app')

@section('title') Publications @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Publication: {{ ucwords($publication->name) }}</h3>
		<p>Update Publication</p>
		@include('includes.all')

		<form action="{{ route('eic.open.publication.post') }}" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="publication_id" value="{{ $publication->id }}">
			<div class="row">
				@foreach($sections as $s)
					<div class="col-md-4">
						<div class="form-group" style="overflow: auto;">
							<input type="checkbox" name="section[]" value="{{ $s->id }}" id="section{{ $s->id }}" @foreach($open as $o)
									@if($o->section_id == $s->id)
										checked 
									@endif
								@endforeach
							>
							<label for="section{{ $s->id }}">{{ ucwords($s->name) }}</label>
						</div>
					</div>

				@endforeach
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Save</button>
				<a href="{{ route('eic.close.publication', ['id' => encrypt($publication->id)]) }}" class="btn btn-danger">Close</a>
			</div>
		</form>
		
	</div>

</div>
@endsection