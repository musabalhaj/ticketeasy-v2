<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organizer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Support\Facades\Validator;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Search = $request->search;
        if ($Search && $Search != ' ') {
            $Organizer = User::where('name','LIKE',"%{$Search}%")->where('role','Organizer')->orderByDesc('id')->paginate(20);
            if ($Organizer->count() == 0) {
                $Organizer = User::where('role','Organizer')->orderByDesc('id')->paginate(20);

                session()->flash('error','No Record With This Name');

                return redirect()->back();
            }
        }
        else{
            $Organizer = User::where('role','Organizer')->orderByDesc('id')->paginate(20);
        }
        return view('Admin/Organizer.index')
        ->with('Organizers',$Organizer);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin/Organizer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request , User $Organizer)
    {

        $Organizer->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'role'=>'Organizer'
        ]);

        session()->flash('success','Added Successfully');
        
        return redirect(route('Organizer.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Admin/Organizer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $Organizer)
    {
        return view('Admin/Organizer.edit')
        ->with('Organizer',$Organizer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $Organizer)
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

                return redirect()->back()->withErrors($validator);
            }
            // update after pass the validation
            $Organizer->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> Hash::make($request->password)
            ]);
        }

        //if the Organizer donnot type a new password
        else{
            $Organizer->update([
                'name'=>$request->name,
                'email'=>$request->email
            ]);
        }

        session()->flash('success','Updated Successfully');
        
        return redirect(route('Organizer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $Organizer)
    {
        //delete Organizer data
        $Organizer->delete();

        session()->flash('success','Deleted Successfully');
        
        return redirect(route('Organizer.index'));
    }
}