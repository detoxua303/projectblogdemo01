<!--blog\resources\views\admin\posts\index.blade.php-->
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
				<th>Photo Id</th>
				<th>Sl No.</th>
				<th>Post Id</th>
				<th>User Id</th>
				<th>Category Id</th>
				<th>Title</th>
				<th colspan="2">Body</th>
				<th>Created On</th>
				<th colspan="2">Options</th>
			</thead>
			<tbody>
				@if($posts)
					@foreach($posts as $post)
						<tr>
							<td><img width='200' height='40' src="/images/{{$post->photo ? $post->photo->name : 'banner01.jpg'}}"></td>
							<td>{{$count = $count+1}}</td>
							<td>{{$post->id}}</td>
							<td>{{$post->user->name}}</td>
							<td>{{$post->category_id==0 ? 'Uncategorized' : $post->category->name }}</td>
							<td>{{$post->title}}</td>
							<td colspan="2">{{$post->body}}</td>
							<td>{{$post->created_at->diffForHumans()}}</td>
							<td>
								<a href="{{route('posts.edit',$post->id)}}">
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