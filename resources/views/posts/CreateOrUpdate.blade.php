@extends('layouts.app')

@section('title')

	@if(isset($post_edit)) Update @else Create @endif Post

@endsection

@section('content')

	<div class="card">
		<div class="card-header">@if(isset($post_edit)) Update @else Create @endif Post</div>
		<div class="card-body">
			
			{{ Form::open(['action' => isset($post_edit)?['PostController@update', $post_edit]:'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

				{{ Form::label('title', 'Title', ['class' => 'col-form-label']) }}
				{{ Form::text('title', isset($post_edit)? $post_edit->title: '', ['class' => 'form-control']) }}

				{{ Form::label('content', 'Content', ['class' => 'col-form-label']) }}
				{{ Form::textarea('content', isset($post_edit)? $post_edit->content: '', ['class' => 'form-control']) }}

				{{ Form::label('photos', 'Photos', ['class' => 'col-form-label']) }}
				@if ($post_edit)
					@foreach($post_edit->photos as $photo)
						<img src="{{ URL::to('/')}}/storage/attachments/{{ $photo->attachment }}" width="50" height="50">
					@endforeach
				@endif
				{{ Form::file('photos[]', ['class' => 'form-control', 'multiple']) }}

				@if(isset($post_edit))
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

@section('scripts')
	<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection