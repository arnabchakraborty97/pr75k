@extends('layouts.app')

@section('title')

	Categories

@endsection

@section('content')

	<div class="card">
		<div class="card-header">Categories</div>
		<div class="card-body">
			
			@if(count($categories) > 0)

				<table class="table table-bordered">
					<thead class="thead-dark">
						<th>Name</th>
						<th colspan="2">Actions</th>
					</thead>
					<tbody class="tbody-light">
						@foreach($categories as $category)
							<tr>
								<td>{{ $category->name }}</td>
								<td>
									<a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
								</td>
								<td>
									{{ Form::open(['action' => ['CategoryController@destroy', $category], 'method' => 'POST']) }}

										{{ Form::hidden('_method', 'DELETE') }}
										{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}

									{{ Form::close() }}
								</td>
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

	<div class="text-center">
		<a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
	</div>

@endsection