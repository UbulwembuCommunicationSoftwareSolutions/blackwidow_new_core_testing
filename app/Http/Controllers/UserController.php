<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function  store(){

    }

    public function update(Request $request, User $user ){
        $data = $request->all();
        $selected_institutions = $data['selected_institutions'];
        $available_institutions = $data['available_institutions'];
        unset($data['user']);
        unset($data['available_institutions']);
        unset($data['selected_institutions']);
        $user->update($data);
        $user->save();
        foreach($user->institutions as $institution){
            $institution->delete();
        }
        foreach($selected_institutions as $institution){
            $new_institution = new Institution(['institution_id' => $institution->id]);
            $user->institutions()->save($new_institution);
        }
        $request->session()->flash('status', 'User updated successfully!');
        $available_institutions = [];
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
