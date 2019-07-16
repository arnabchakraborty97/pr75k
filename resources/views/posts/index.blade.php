@extends('layouts.app')

@section('title')

	Posts

@endsection

@section('content')

	@if(count($posts) > 0)
		<ul class="list-group">
			@foreach($posts as $post)

				<li class="list-group-item">
					<h4><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>

					@foreach($post->photos as $photo)

						<img src="{{ URL::to('/')}}/storage/attachments/{{ $photo->attachment }}" width="200" height="200"><br>

					@endforeach

					@if($post->user == Auth::user())
						<a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>

						{{ Form::open(['action' => ['PostController@destroy', $post], 'method' => 'POST']) }}

							{{ Form::hidden('_method', 'DELETE') }}

							{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}

						{{ Form::close() }}
					@endif

				</li>

			@endforeach
		</ul>
	@else
		Noithing to show
	@endif

	@auth

		<div class="text-center">
			<a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
		</div>

	@endauth

@endsection