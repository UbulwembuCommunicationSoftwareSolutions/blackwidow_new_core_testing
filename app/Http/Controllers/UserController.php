<?php

namespace App\Http\Controllers;

use App\Models\Institution;
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
        $institutions = Institution::get();
        $user_institutions = array();
        $available_institutions = array();
        foreach($institutions as $institution){
            $available_institutions[] = array(
                'id' => $institution->id,
                'label' => $institution->description
            );
        }
        foreach($user->institutions as $institution) {
            $user_institutions[] = $institution->id;
        }
        if((Auth::user()->isAdmin())){
            return Inertia::render('User/Edit', [
                'available_institutions' => $available_institutions,
                'user_institutions' => $user_institutions,
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
        $selected_institutions = $data['selected_institutions'] ?? [];
        unset($data['user']);
        unset($data['available_institutions']);
        unset($data['selected_institutions']);
        $user->update($data);
        $user->save();
        $user->institutions()->sync($selected_institutions);
        $request->session()->flash('status', 'User updated successfully!');

        $available_institutions = array();
        $user_institutions = array();

        $institutions = Institution::get();
        foreach($institutions as $institution){
            $available_institutions[] =array(
                'id' => $institution->id,
                'label' => $institution->description
            );
        }
        foreach($user->institutions as $institution) {
            $user_institutions[] = $institution->id;
        }
        return Inertia::render('User/Edit', [
            'available_institutions' => $available_institutions,
            'user_institutions' => $user_institutions,
            'user' => $user,
            'status' => session('status'),
        ]);

    }
}
