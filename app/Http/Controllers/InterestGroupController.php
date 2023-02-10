<?php

namespace App\Http\Controllers;

use App\Models\people;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class InterestGroupController extends Controller
{
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $interest_groups = InterestGroup::all();
            $interest_groups->load('people');
        }else{
            $interest_groups = Auth::user()->departments;
            $interest_groups->load('people');
        }

        return Inertia::render(
            'Department/Index',
            [
                'departments' => $interest_groups
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Department/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required',
        ]);
        InterestGroup::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'content' => $request->name
        ]);
        sleep(1);

        return redirect()->route('departments.index')->with('message', 'Department Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $interest_group
     * @return \Illuminate\Http\Response
     */
    public function show(Department $interest_group)
    {
        $interest_group->load('people');
        $interest_group->load('people.incidents');
        return Inertia::render('InterestGroup/Show', [
            'interest_group' => $interest_group,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $interest_group
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $interest_group = InterestGroup::find($id);
        $peoples = people::get();
        $selected_institute = array(
            "id" => $interest_group->people_id,
            "description" => $interest_group->people->description
        );
        if((Auth::user()->isAdmin())){
            return Inertia::render('Department/Edit', [
                'peoples' => $peoples,
                "selected_institute" => $selected_institute,
                'department' => $interest_group,
                'status' => session('status'),
            ]);
        }else{
            return Inertia::render('Unauthorised', [
                'status' => session('status'),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $interest_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $interest_group ){
        $data = $request->all();
        $interest_group->update($data['department']);
        $interest_group->people_id = $data['selected_institute']['id'];
        $interest_group->save();
        $request->session()->flash('status', 'Department updated successfully!');

        return redirect()->route('department.index')->with('message', 'Department Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $interest_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $interest_group)
    {
        $interest_group->delete();
        sleep(1);

        return redirect()->route('departments.index')->with('message', 'Department Delete Successfully');
    }
}
