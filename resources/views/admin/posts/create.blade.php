<!--blog\resources\views\admin\posts\create.blade.php-->
@extends('layouts.admin')
@section('content')
	<div><h3>Create Posts</h3></div>
	{!!Form::open(['method'=>'POST','action'=>'AdminPostsController@store','files'=>'true'])!!}
		<div class="form-group">
			{!!Form::label('title','Title: ')!!}
			{!!Form::text('title',null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('category_id','Category: ')!!}
			{!!Form::select('category_id',[''=>'Choose Option']+$categories,0,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('body','Body: ')!!}
			{!!Form::textarea('body',null,['class'=>'form-control','rows'=>3])!!}
		</div>
		<div class="form-group">
			{!!Form::label('photo_id','Upload User Pic: ')!!}
			{!!Form::file('photo_id',null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::submit('Create Posts',['class'=>'btn btn-primary'])!!}
		</div>
	{!!Form::close()!!}
	@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
@endsection('content')