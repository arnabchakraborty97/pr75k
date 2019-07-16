@extends('layouts.app')

@section('title')

	{{ $post->title }}

@endsection

@section('content')

	<div class="card">
		<div class="card-header">{{ $post->title }}</div>
		<div class="card-body">
			{!! nl2br($post->content) !!}
		</div>

		@foreach($post->photos as $photo)

			<img src="{{ URL::to('/')}}/storage/attachments/{{ $photo->attachment }}" width="200" height="200"><br>

		@endforeach		

		@if (Auth::user() && Auth::user() == $post->user)
			<a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm col-sm-1">Edit</a>

			{{ Form::open(['action' => ['PostController@destroy', $post], 'method' => 'POST']) }}

				{{ Form::hidden('_method', 'DELETE') }}

				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm col-sm-1']) }}

			{{ Form::close() }}
		@endif

	</div>

@endsection