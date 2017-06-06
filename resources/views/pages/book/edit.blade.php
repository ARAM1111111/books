@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>EDIT CRUD</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="{{route('book.update',$book->id)}}" method="post">
				{{method_field('PATCH')}}
				{{csrf_field()}}
				
				<div class="form-group {{($errors->has('title'))?$errors->first('title'):""}}">
					<input type="text" name="title" class="form-control" placeholder="Enter title" value="{{$book->title}}">
					{!! $errors->first('title','<p class="alert alert-danger help-block">:message</p>') !!}
				</div>
				<div class="form-group {{($errors->has('desc'))?$errors->first('desc'):""}}">
					<input type="text" name="desc" class="form-control" placeholder="Enter desc" value="{{$book->desc}}">
					{!! $errors->first('desc','<p class="alert alert-danger help-block">:message</p>') !!}
				</div> 
				 <div class="form-group {{($errors->has('name'))?$errors->first('name'):""}}">
					{{-- <input type="text" name="name" class="form-control" placeholder="Enter author name"> --}}
					<label>Choose authors</label>
					<select name="name[]" id="multiselect" multiple="multiple">
						@if(isset($authors))
							@foreach($authors as $author)
						    	<option {{ (in_array($author->id, $checked_authors))?"selected":"" }}  value="{{$author->id}}">{{$author->name}}</option>
						    @endforeach
						@endif
					</select>
					{!! $errors->first('name','<p class="alert alert-danger help-block">:message</p>') !!}
				</div><br>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="save">
				</div>
			</form>
		</div>
	</div>
@endsection