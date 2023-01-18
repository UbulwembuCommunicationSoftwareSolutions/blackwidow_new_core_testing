<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class DepartmentController extends Controller
{
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $departments = Department::all();
            $departments->load('institution');
        }else{
            $departments = Auth::user()->departments;
            $departments->load('institution');
        }

        return Inertia::render(
            'Department/Index',
            [
                'departments' => $departments
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
        Department::create([
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $department = Department::find($id);
        $institutions = Institution::get();
        $selected_institute = array(
            "id" => $department->institution_id,
            "description" => $department->institution->description
        );
        if((Auth::user()->isAdmin())){
            return Inertia::render('Department/Edit', [
                'institutions' => $institutions,
                "selected_institute" => $selected_institute,
                'department' => $department,
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department ){
        $data = $request->all();
        $department->update($data['department']);
        $department->institution_id = $data['selected_institute']['id'];
        $department->save();
        $request->session()->flash('status', 'Department updated successfully!');

        return redirect()->route('department.index')->with('message', 'Department Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        sleep(1);

        return redirect()->route('departments.index')->with('message', 'Department Delete Successfully');
    }
}
