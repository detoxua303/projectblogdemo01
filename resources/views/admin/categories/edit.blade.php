<!--blog\resources\views\admin\users\edit.blade.php-->
@extends('layouts.admin')
@section('content')
<div class="row"><h3>Edit Users</h3></div>
<div class="row">
	<div class="col-sm-3">
		<img src="/images/{{$user->photo ? $user->photo->name : 'face_placeholder.png'}}" alt="" class="img-responsive img-rounded">
	</div>
	<div class="col-sm-9">
		{!!Form::model($user,['method'=>'PATCH','action'=>['AdminUserController@update',$user->id],'files'=>'true'])!!}
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
				{!!Form::select('status',array(1=>'Active',0=>'Not Active'),null,['class'=>'form-control'])!!}
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
				{!!Form::submit('Edit User',['class'=>'btn btn-primary'])!!}
			</div>
		{!!Form::close()!!}
		
		{!!Form::open(['method'=>'DELETE','action'=>['AdminUserController@destroy',$user->id]])!!}	
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