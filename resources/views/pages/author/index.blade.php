@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Author CRUD</h1>
		</div>
	</div>
	
	<div class="row">
		<table class="table table-striped">
			<tr>
				<th>No.</th>
				<th>Name</th>
				<th>Count Written books</th>
				<th>Actions</th>
			</tr>
			<a href="{{route('author.create')}}" class="btn btn-success pull-right">+</a><br>
			<?php $n = 1; ?>
			@if(isset($authors) && count($authors) >0)
				@foreach($authors as $author)
					<tr>
						<td style="cursor: pointer"><a href="{{route('author.show',$author->id)}}">{{$n++}}</a></td>
						<td>{{$author->name}}</td>
						<td>{{$author->books()->count()}}</td>

						<td>
							<form action="{{route('author.destroy',$author->id)}}" method="post">
								{{method_field("delete")}}
								{{csrf_field()}}
								<a href="{{route('author.edit',$author->id)}}" class="btn btn-primary">EDIT</a>
								<input type="submit" class="btn btn-warning" name="del" value="DELETE" onclick="return confirm('ARE YOU SURE???')">
							</form>
						</td>
					</tr>
				@endforeach
			@else
				<h1>Create authors for showing</h1>
			@endif
		</table>
	</div>
@endsection