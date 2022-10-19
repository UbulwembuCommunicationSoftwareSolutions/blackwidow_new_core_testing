<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function  store(){

    }

    public function update(Request $request, User $user ){
        $data = $request->all();
        dd($data);
        $user->update($data);
        $user->save();
        $request->session()->flash('status', 'User updated successfully!');
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
        return Inertia::render('Admin/UserEdit', [
            'available_institutions' => $available_institutions,
            'user_institutions' => $user_institutions,
            'user' => $user,
            'status' => session('status'),
        ]);

    }
}
