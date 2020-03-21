<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use App\Photo;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $count = 0;
        return view('admin.users.index',compact('users','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $input = $request->all();
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
        $input['password'] = bcrypt($request->password);
        //persist the data into User database
        User::create($input);
        //redirect to view users page
        return redirect('/admin/users');
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
        //get data of the user from the User database and store it
        $user = User::findOrFail($id);
        //get all the name and id of the roles available at Role database
        $roles = Role::pluck('name','id')->all();
        //send the $user and $role data(above to steps, i.e roles and user)
        return view('admin.users.edit',compact('roles','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //find the 
        //return $request->all();
        $user = User::findOrFail($id);
        $input = $request->all();
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
        $input['password'] = bcrypt($request->password);
        //edit the data of the user database
        $user->update($input);
        //show flash message
        Session::flash('updated_user','The User has been Updated');
        //redirect to view users page
        return redirect('/admin/users');
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
        $user = User::findOrFail($id);
        //delete files from storage of the user
        unlink(public_path()."/images/".$user->photo->name);
        //delete the user from database
        $user->delete();
        //show flash message
        Session::flash('deleted_user','The User has been Deleted');
        //return to admin/users page
        return redirect('/admin/users');
    }
}
