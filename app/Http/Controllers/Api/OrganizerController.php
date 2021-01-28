<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('role','Organizer')->get();
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
            'password'=>'required|min:4|max:25|confirmed',
            'password_confirmation' => 'required',
        );

        // validate all data that come from request
        $validator = Validator::make($request->all(),$rules);

        // check if you have errors in the data
        if ($validator->fails()) {

            return response()->json($validator->errors(),401);
        }  

        // else create new Organizer with requested data   
        else{
            $Organizer = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password),
                'role'=>'Organizer'
            ]);

            return ['Success'=>'Organizer Created Successfuly.'];
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
        return User::where('role','Organizer')->findOrFail($id);
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
        //if the Organizer type a new password
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

                return response()->json($validator->errors(),401);
            }

            // else update with requested data   
            else{
                $Organizer = User::where('role','Organizer')->findOrFail($id);

                $Organizer->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=> Hash::make($request->password),
                ]);

                return ['Success'=>'Organizer Updated Successfuly.'];
            }
        }
        // if empty password
        else{
            // fields you want to validate
            $rules = array(
                'name'=>'required|min:4|max:50',
                'email'=>'required|email',
            );

            // validate all data that come from request
            $validator = Validator::make($request->all(),$rules);

            // check if you have errors in the data
            if ($validator->fails()) {

                return response()->json($validator->errors(),401);
            }

            // else update with requested data   
            else{
                $Organizer = User::where('role','Organizer')->findOrFail($id);

                $Organizer->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                ]);

                return ['Success'=>'Organizer Updated Successfuly.'];
            }
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
        $Organizer = User::where('role','Organizer')->findOrFail($id);

        $Organizer->delete();

        if ($Organizer) {
            return ['Success'=>'Organizer Deleted Successfuly.'];
        }else{
            return ['Erorr'=>'Try Agin Later.'];
        }
    }
}
