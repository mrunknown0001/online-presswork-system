@extends('layouts.app')

@section('title') Add Section Editor @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Add Section Editor</h3>

		<p>
			<a href="{{ route('eic.section.editor.management') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Section Editor Management</a>
		</p>
		
		<div class="content-box-header">
			<div class="panel-title">Add Section Editor Form</div>

			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')
			<form action="{{ route('eic.add.section.editor.post') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Firstname</label>
							<input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname" required>
						</div>
						<div class="col-md-6">
							<label>Lastname</label>
							<input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Username</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Username" required>							
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Select Section</label>
							<select name="section" id="section" class="form-control" required>
								<option value="">Select Section</option>
								@if(count($sections) > 0)
									@foreach($sections as $s)
										<option value="{{ $s->id }}">{{ ucwords($s->name) }}</option>
									@endforeach
								@else
									<option value="">No Section Available</option>
								@endif 
							</select>						
						</div>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Section Editor</button>
					<a href="{{ route('eic.section.editor.management') }}" class="btn btn-danger">Cancel</a>
				</div>
			</form>
		</div>


	</div>
</div>
@endsection