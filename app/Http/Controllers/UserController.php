<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $Search = $request->search;
        if ($Search && $Search != ' ') {
            $User = User::where('name','LIKE',"%{$Search}%")->where('role','User')->paginate(10);
            if ($User->count() == 0) {
                $User = User::where('role','User')->paginate(10);

                session()->flash('error','No Record With This Name');

                return redirect()->back();
            }
        }
        else{
            $User = User::where('role','User')->paginate(10);
        }
        return view('Admin/User.index')
        ->with('Users',$User);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request , User $User)
    {

        $User->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'role'=>'User'
        ]);

        session()->flash('success','Added Successfully');
        
        return redirect(route('User.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Admin/User.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        return view('Admin/User.edit')
        ->with('User',$User);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $User)
    {
        //if the user type a new password
        if (!empty($request->password)) {

            // fields you want to validate
            $rules = array(
                'name'=>'required|min:4|max:50',
                'email'=>'required|email',
                'password'=>'required|min:4|max:25|confirmed',
                'password_confirmation' => 'required',
            );

            // validate all data that come from request
            $validator = Validator::make($request->all(),$rules);

            // check if you have errors in the data
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator);
            }
            // update after pass the validation
            $User->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password)
            ]);
        }

        //if the user donnot type a new password
        else{
            $User->update([
                'name'=>$request->name,
                'email'=>$request->email
            ]);
        }

        session()->flash('success','Updated Successfully');
        
        return redirect(route('User.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        //delete user data
        $User->delete();

        session()->flash('success','Deleted Successfully');
        
        return redirect(route('User.index'));
    }
}
