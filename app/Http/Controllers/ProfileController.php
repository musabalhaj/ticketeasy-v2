<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile($id){  
        try {
            $id = decrypt($id);
        } 
        catch (\Throwable $th) {
            return redirect()->back();
        }
        $User= User::where('id',$id)->findOrFail($id);
        
        return view('profile')->with('User',$User);
    }

    public function updateProfile(UpdateUserRequest $request , $id){
        
        try {
            $id = decrypt($id);
        } 
        catch (\Throwable $th) {
            return redirect()->back();
        }

        $User= User::where('id',$id)->findOrFail($id);
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
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = Hash::make($request->password);
            $User->save();
        }
        else{
            $User->name = $request->name;
            $User->email = $request->email;
            $User->save(); 
        }

        session()->flash('success','Updated Successfully');
        
        return redirect()->back();

    }
}
