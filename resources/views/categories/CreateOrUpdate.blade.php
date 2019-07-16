@extends('layouts.app')

@section('title')

	@if(isset($category_edit)) Update @else Create @endif Category

@endsection

@section('content')

	<div class="card">
		<div class="card-header">@if(isset($category_edit)) Update @else Create @endif Category</div>
		<div class="card-body">
			
			{{ Form::open(['action' => isset($category_edit)?['CategoryController@update', $category_edit]:'CategoryController@store', 'method' => 'POST']) }}

				{{ Form::label('name', 'Name', ['class' => 'col-form-label']) }}
				{{ Form::text('name', isset($category_edit)? $category_edit->name: '', ['class' => 'form-control']) }}


				@if(isset($category_edit))
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

