<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Gate;   //important to allowing access

class UserController extends Controller
{

    /**   NEW*********************************
     * Create a new controller instance.
     *
     * @return void
     *
     * This protects all the pages below - you can't see any unless you log in -if you do not write any exeptions
     *  call auth middleware - access control
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }


    //DELETED - CREATE - STORE - SHOW = DON'T NEED THESE

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id   <--- Had to modify parameter in public function from $id to User $user
     * @return
     */
    public function edit(User $user)
    {
        //dd($user);

        //use the GATE - can use denies or allows
        if(Gate::denies('edit-users')){
            return  redirect(route('admin.users.index'))->with('error', 'You do not have authorization to EDIT');
        }

        $roles = Role::all();

        //check user
       /* if(auth()->user()->id !==$roles->user_id){
            //redirect not authorized
            return  redirect(route('admin.users.index'))->with('error', 'You do not have authorization to EDIT');
        }*/


        return view('admin.users.edit')->with([
           'user' => $user,
           'roles' => $roles
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id   <--- Had to modify parameter in public function from $id to User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request);
        $user->roles()->sync($request->roles);

        //update name and email from edit page
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Success - User ROLES - UPDATED');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User   <--- Had to modify parameter in public function from $id to User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //dd($user);

        //use the GATE - can use denies or allows
        if(Gate::denies('delete-users')){
            return  redirect(route('admin.users.index'))->with('error', 'You do not have authorization to DELETE');
        }

        $user->roles()->detach(); //   removes all roles from the user
        $user->delete();   //  deletes the user

        return redirect()->route('admin.users.index')->with('success', 'Success - User - DELETED');

    }
}
