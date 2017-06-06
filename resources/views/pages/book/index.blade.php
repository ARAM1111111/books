@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>Book CRUD</h1>
		</div>
	</div>
	
	<div class="row">
		<table class="table table-striped">
			<tr>
				<th>No.</th>
				<th>Title</th>
				<th>Desc</th>
				<th>Author</th>
				<th>ACTIONS</th>
			</tr>
			<a href="{{route('book.create')}}" class="btn btn-success pull-right">+</a><br>
			<?php $n = 1; ?>
			@if(isset($books) && count($books)>0)
				@foreach($books as $book)
					<tr>
						<td>{{$n++}}</td>
						<td>{{$book->title}}</td>
						<td>{{$book->desc}}</td>
						<td>
							<ul>
								@foreach($book->authors as  $author)
									<li>{{$author->name}}</li>
								@endforeach
							</ul>
						</td>
						
						<td>
							<form action="{{route('book.destroy',$book->id)}}" method="post">
								{{method_field("delete")}}
								{{csrf_field()}}
								<a href="{{route('book.edit',$book->id)}}" class="btn btn-primary editBook">EDIT</a>
								<input type="submit" class="btn btn-warning" name="del" value="DELETE" onclick="return confirm('ARE YOU SURE???')">
							</form>
						</td>
					</tr>
				@endforeach
				@else
					<h1>Create books for showing</h1>
			@endif
		</table>
	</div>
@endsection