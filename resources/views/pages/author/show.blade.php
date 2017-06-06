@extends('layouts.app')


@section('content')
	@if(isset($author) && $author->books->count() > 0)
		
		<div class="row">
			<div class="col-md-12">
				<h1>{{$author->name}}</h1>
			</div>
		</div>
		
		<div class="row">
			<table class="table table-striped">
				<tr>
					<th>No.</th>
					<th>Books</th>
					<th>Descreption</th>
					
				</tr>
				<?php $n = 1; ?>
				@foreach($author->books as $book)
					<tr>
						<td>{{$n++}}</td>
						<td>{{$book->title}}</td>
						<td>{{$book->desc}}</td>
					</tr>
				@endforeach
			</table>
		</div>

	@else
		<h1>No books for showing</h1>
	@endif

	<a href="{{route('author.index')}}" class="btn btn-success">Back</a>
@endsection