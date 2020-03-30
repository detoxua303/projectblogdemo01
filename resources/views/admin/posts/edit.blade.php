<!--blog\resources\views\admin\posts\edit.blade.php-->
@extends('layouts.admin')
@section('content')
<div class="row"><h3>Edit Users</h3></div>
<div class="row">
	<div class="col-sm-3">
		<img src="/images/{{$post->photo ? $post->photo->name : 'banner01.jpg'}}" alt="" class="img-responsive img-rounded">
	</div>
	<div class="col-sm-9">
		{!!Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id],'files'=>'true'])!!}
			<div class="form-group">
				{!!Form::label('title','Title: ')!!}
				{!!Form::text('title',null,['class'=>'form-control'])!!}
			</div>
			<div class="form-group">
				{!!Form::label('category_id','Category: ')!!}
				{!!Form::select('category_id',array(1=>'Category 1',0=>'Choose Option'),null,['class'=>'form-control'])!!}
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
		{!!Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]])!!}	
			<div class="form-group">
				{!!Form::submit('Delete User',['class'=>'btn btn-danger'])!!}
			</div>
		{!!Form::close()!!}
	</div>	
</div>
<div class="row">
	@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
	@endif
</div>
	
	
@endsection('content')