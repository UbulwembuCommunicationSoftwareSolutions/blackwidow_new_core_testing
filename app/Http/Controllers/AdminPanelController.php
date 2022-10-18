<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AdminPanelController extends Controller
{
    public function index(){
        if((Auth::user()->isAdmin())){
            $users = User::get();
            return Inertia::render('Admin/Panel', [
                'users' => $users,
                'status' => session('status'),
            ]);
        }else{
            return Inertia::render('Unauthorised', [
                'status' => session('status'),
            ]);
        }
    }

    public function listUsers(){
        if((Auth::user()->isAdmin())){
            $users = User::get();
            $users->load('roles');
            $users->load('institutions');
            return Inertia::render('Admin/Users', [
                'users' => $users,
                'status' => session('status'),
            ]);
        }else{
            return Inertia::render('Unauthorised', [
                'status' => session('status'),
            ]);
        }
    }
    public function editUser($id){
        $user = User::find($id);
        $institutions = Institution::get();
        foreach($institutions as $institution){
            $available_institutions[] =array(
                'id' => $institution->id,
                'label' => $institution->description
            );
        }
        foreach($user->institutions as $institution){
            $user_institutions[] = [$institution->description,$institution->id];
        }
        if((Auth::user()->isAdmin())){
            return Inertia::render('Admin/UserEdit', [
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
}
