@extends('layouts.app')

@section('title')

	Videos

@endsection

@section('content')

	<div class="card">
		<div class="card-header">Videos</div>
		<div class="card-body">
			
			@if(count($videos) > 0)

				<table class="table table-bordered">
					<thead class="thead-dark">
						<th>Category</th>
						<th>URL</th>
						<th>Added by</th>
						@auth<th colspan="2">Actions</th>@endauth
					</thead>
					<tbody class="tbody-light">
						@foreach($videos as $video)
							<tr>
								<td>{{ $video->category->name }}</td>
								<td>
									<iframe width="560" height="315" src="{{ $video->url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</td>
								<td>{{ $video->user->name }}</td>
								@auth
									@if ($video->user == Auth::user())
										<td>
											<a href="{{ route('videos.edit', $video) }}" class="btn btn-primary btn-sm">Edit</a>
										</td>
										<td>
											{{ Form::open(['action' => ['VideoController@destroy', $video], 'method' => 'POST']) }}

												{{ Form::hidden('_method', 'DELETE') }}
												{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}

											{{ Form::close() }}
										</td>
									@endif
								@endauth
							</tr>
						@endforeach
					</tbody>
				</table>
			@else
				Nothing to show
			@endif

		</div>
	</div>

	<br>

	@auth
		<div class="text-center">
			<a href="{{ route('videos.create') }}" class="btn btn-success">Add Video</a>
		</div>
	@endauth

@endsection