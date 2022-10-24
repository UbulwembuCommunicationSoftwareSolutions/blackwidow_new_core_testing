<?php

namespace App\Http\Controllers;

use App\Models\Department;
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
            $departments = Department::get();
            return Inertia::render('Admin/Panel', [
                'users' => $users,
                'departments' => $departments,
                'status' => session('status'),
            ]);
        }else{
            return Inertia::render('Unauthorised', [
                'status' => session('status'),
            ]);
        }
    }
}
