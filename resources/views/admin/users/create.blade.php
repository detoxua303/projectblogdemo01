<!--blog\resources\views\admin\users\index.blade.php-->
@extends('layouts.admin')
@section('content')
	<div><h3>Create Admin</h3></div>
	{!!Form::open(['method'=>'POST','action'=>'AdminUserController@store','files'=>'true'])!!}
		<div class="form-group">
			{!!Form::label('name','Name: ')!!}
			{!!Form::text('name',null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('email','Email: ')!!}
			{!!Form::text('email',null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('role_id','Role: ')!!}
			{!!Form::select('role_id',[""=>'Choose Option']+$roles,null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('status','Status: ')!!}
			{!!Form::select('status',array(1=>'Active',0=>'Not Active'),0,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('password','Password: ')!!}
			{!!Form::password('password',['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::label('photo_id','Upload User Pic: ')!!}
			{!!Form::file('photo_id',null,['class'=>'form-control'])!!}
		</div>
		<div class="form-group">
			{!!Form::submit('Create User',['class'=>'btn btn-primary'])!!}
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