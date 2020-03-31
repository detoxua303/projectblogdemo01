<!--blog\resources\views\admin\users\index.blade.php-->
@extends('layouts.admin')
@section('content')
	@if(Session::has('deleted_user'))
		<div class="bg-danger">
			{{session('deleted_user')}}
		</div>
	@endif
	@if(Session::has('updated_user'))
		<div class="bg-danger">
			{{session('updated_user')}}
		</div>
	@endif
	<h3>This is Admin->User CRUD Home Page</h3>
	<div>
		<table class="table table-bordered">
			<thead>
				<th>Sl No.</th>
				<th>Photo</th>
				<th>User Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Role</th>
				<th>Status</th>
				<th>Created</th>
				<th colspan="2">Options</th>
			</thead>
			<tbody>
				@if($users)
					@foreach($users as $user)
						<tr>
							<td>{{$count = $count+1}}</td>
							<td><img src="/images/{{$user->photo ? $user->photo->name : 'face_placeholder.png'}}" width="50" height="50"></td>
							<td>{{$user->id}}</td>
							<td>{{$user->name}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->role==NULL?'Not Assigned': $user->role->name}}</td>
							<td>{{$user->status==1?'Active':'Not Active'}}</td>
							<td>{{$user->created_at->diffForHumans()}}</td>
							<td>
								<a href="{{route('users.edit',$user->id)}}">
									<img src="{{URL('images/edit.png')}}"  alt="edit" width="20" height="20">
								</a>
							</td>
							<td>
								<a href="#">
									<img src="{{URL('images/delete.png')}}"  alt="delete" width="20" height="20">
								</a>
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</div>
@endsection('content')