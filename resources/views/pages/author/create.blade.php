@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>CREATE CRUD</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('author.store')}}" method="post">
				{{csrf_field()}}


				<div class="form-group {{($errors->has('name'))?$errors->first('name'):""}}">
					<input type="text" name="name" class="form-control" placeholder="Enter author name">
					{!! $errors->first('name','<p class="alert alert-danger help-block">:message</p>') !!}
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="save">
				</div>
			</form>
		</div>
	</div>
@endsection