@extends('layouts.app')

@section('title') Activity Entry Send Email @endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Send Email in Activity Entry</h3>
		<p>
			<a href="{{ route('eic.activities') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to Activities</a>
		</p>

		<div class="content-box-header">
			<div class="panel-title">Send Email</div>

			<div class="panel-options">
				{{--<a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
				<a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>--}}
			</div>
		</div>
		<div class="content-box-large box-with-header">
			@include('includes.all')

			<form action="{{ route('eic.send.mail.activity.entry.post') }}" method="POST" autocomplete="off">
				{{ csrf_field() }}
				<input type="hidden" name="id" value="{{ $activity->id }}">
				<input type="hidden" name="eid" value="{{ $entry->id }}">
				<div class="form-group">
					<label>Email Subject</label>
					<input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Email Subject" required>
				</div>
				<div class="form-group">
					<label>Email Content</label>
					<textarea name="content" id="content" class="form-control" placeholder="Email Message Content" rows="5" required></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Send Email</button>
				</div>
			</form>

		</div>


	</div>
</div>
@endsection