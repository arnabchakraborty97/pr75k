@extends('layouts.app')

@section('title')

	@if(isset($video_edit)) Update @else Create @endif Video

@endsection

@section('content')

	<div class="card">
		<div class="card-header">@if(isset($video_edit)) Update @else Create @endif Video</div>
		<div class="card-body">
			
			{{ Form::open(['action' => isset($video_edit)?['VideoController@update', $video_edit]:'VideoController@store', 'method' => 'POST']) }}

				{{ Form::label('category_id', 'Category', ['class' => 'col-form-label']) }}
				<select name="category_id" for="category_id" class="form-control">
					@foreach($categories as $category)
						<option value="{{ $category->id }}" @if(isset($video_edit)) @if($video_edit->category->id == $category->id) selected @endif @endif>{{ $category->name }}</option>
					@endforeach
				</select>

				{{ Form::label('url', 'URL', ['class' => 'col-form-label']) }}
				{{ Form::url('url', isset($video_edit)? $video_edit->url: '', ['class' => 'form-control']) }}


				@if(isset($video_edit))
					{{ Form::hidden('_method', 'PUT') }}
				@endif

				<br>

				<div class="text-center">
					{{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
				</div>

			{{ Form::close() }}

		</div>
	</div>

@endsection

