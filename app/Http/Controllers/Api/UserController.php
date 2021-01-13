<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('role','User')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fields you want to validate
        $rules = array(
            'name'=>'required|min:4|max:50',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:4|max:25',
        );

        // validate all data that come from request
        $validator = Validator::make($request->all(),$rules);

        // check if you have errors in the data
        if ($validator->fails()) {

            return response()->json($validator->errors(),401);
        }  

        // else create new User with requested data   
        else{
            $User = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password),
                'role'=>'User'
            ]);

            return ['Success'=>'User Created Successfuly.'];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('role','User')->findOrFail($id);
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
        // fields you want to validate
        $rules = array(
            'name'=>'required|min:4|max:50',
            'email'=>'required|email',
            // 'password'=>'required|min:4|max:25',
        );

        // validate all data that come from request
        $validator = Validator::make($request->all(),$rules);

        // check if you have errors in the data
        if ($validator->fails()) {

            return response()->json($validator->errors(),401);
        }

        // else create new User with requested data   
        else{
            $User = User::where('role','User')->findOrFail($id);

            $User->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password),
            ]);

            return ['Success'=>'User Updated Successfuly.'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::where('role','User')->findOrFail($id);

        $User->delete();

        if ($User) {
            return ['Success'=>'User Deleted Successfuly.'];
        }else{
            return ['Erorr'=>'Try Agin Later.'];
        }
    }
}
