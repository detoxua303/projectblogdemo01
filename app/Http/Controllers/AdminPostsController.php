<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsCreateRequest;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\User;
use App\Photo;
use App\Category;
use Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        $count = 0; 
        return view('admin.posts.index',compact('posts','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name','id')->all();
        return view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $input = $request->all();
        $user = Auth::user();
        if($file = $request->file('photo_id'))
        {
            //grab the file name from client machine and append current dat and time to it, creating an unique name
            $tempname = time().$file->getClientOriginalName();
            //replace any blank spaces 
            $name = str_replace(' ','',$tempname);
            //move the file to host machine i.e under public/images
            $file->move('images',$name);
            //Persist data('name') into Photo database
            $photo=Photo::create(['name'=>$name]);
            //grab the photo_id generated while persisting the photo into Photo Database(step above). 
            $input['photo_id'] = $photo->id;
        }
        //encrypt the password
        $input['user_id'] = $user->id;
        //persist the data into User database
        Post::create($input);
        //redirect to view users page
        return redirect('/admin/posts');
        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::pluck('name','id')->all();
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        return $request->all();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
