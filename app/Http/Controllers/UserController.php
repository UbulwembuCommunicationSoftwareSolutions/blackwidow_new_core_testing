<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Institution;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function  store(){

    }

    public function index(){
        if((Auth::user()->isAdmin())){
            $users = User::get();
            $users->load('roles');
            $users->load('departments');
            return Inertia::render('User/Index', [
                'users' => $users,
                'status' => session('status'),
            ]);
        }else{
            return Inertia::render('Unauthorised', [
                'status' => session('status'),
            ]);
        }
    }
    public function edit($id){
        $user = User::find($id);
        $departments = Department::get();
        $selected_departments = array();
        $available_departments = array();

        foreach($departments as $department){
            $available_departments[] = array(
                'id' => $department->id,
                'label' => $department->description
            );
        }
        foreach($user->departments as $department) {
            $selected_departments[] = $department->id;
        }
        if((Auth::user()->isAdmin())){
            return Inertia::render('User/Edit', [
                'available_departments' => $available_departments,
                'selected_departments' => $selected_departments,
                'user' => $user,
                'status' => session('status'),
            ]);
        }else{
            return Inertia::render('Unauthorised', [
                'status' => session('status'),
            ]);
        }
    }

    public function update(Request $request, User $user ){
        $data = $request->all();
        $user->departments()->sync($data['selected_departments']);

        $user->update($data['user']);
        $user->save();
        $request->session()->flash('status', 'User updated successfully!');

        return redirect()->route('user.edit',$user);
    }

    public function updateProfilePicture(Request $request ){
        $data = $request->all();
        $user = User::find($request->object_id);
        if($request->hasFile('profile_picture')){
            $fileName = $user->id.'_profile_pic.'.$request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move(public_path('user_files'), $fileName);
            $user->profile_picture = $fileName;
        }
        $user->save();
        $request->session()->flash('status', 'User updated successfully!');
        return Redirect::route('user.edit',$user);

    }
}
