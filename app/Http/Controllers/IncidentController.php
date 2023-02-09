<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use App\Models\Incident;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function PHPUnit\Framework\directoryExists;


class IncidentController extends Controller
{
    public function index()
    {
        $request = Request::all();
        $search = false;
        $sort_by = false;
        $sort_desc = false;
        $filter_by = false;
        $filter_value = false;

        if(array_key_exists('search',$request)){
            if(strlen($request['search'])>0){
                $search = $request['search'];
            }
        }
        if(array_key_exists('sort_by',$request)){
            if(strlen($request['sort_by'])>0){
                $sort_by = $request['sort_by'];
            }
        }
        if(array_key_exists('sort_desc',$request)){
            if(strlen($request['sort_desc'])>0){
                $sort_desc = $request['sort_desc'];
            }
        }
        if(array_key_exists('filter_by',$request)){
            if(strlen($request['filter_by'])>0){
                $filter_by = $request['filter_by'];
            }
        }

        if(array_key_exists('filter_value',$request)){
            if(strlen($request['filter_value'])>0){
                $filter_value = $request['filter_value'];
            }
        }

        if(Auth::user()->isAdmin()){
            $incidents_query = Incident::query();
        }else{
            $incidents_query = Incident::query();
        }

        $incidents_query->with('department');
        $incidents_query->with('user');
        $incidents_query->with('incident_category');
        $incidents_query->with('incident_sub_category');
        $incidents_query->with('incident_sub_sub_category');

        if($filter_by=='department'){
            $incidents_query->WhereHas('department', function ($query) use ($filter_value)  {
                $query->where('description', 'like', '%'.$filter_value.'%');
            });
        }

        if($search){
            $incidents_query
                ->where('incidents.description', 'LIKE', '%' . $search . '%')
                ->orWhere('incidents.id', 'LIKE', '%' . $search . '%')
                ->orWhere('incidents.created_at', 'LIKE', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search)  {
                    $query->where('first_name', 'like', '%'.$search.'%');
                })->orWhereHas('user', function ($query) use ($search)  {
                    $query->where('surname', 'like', '%'.$search.'%');
                })->orWhereHas('department', function ($query) use ($search)  {
                    $query->where('description', 'like', '%'.$search.'%');
                });
        }


        $incidents_query->withCount('people');

        if($sort_by){
            if($sort_desc=="true"){
                $incidents_query->orderBy($sort_by,'DESC');
            }else{
                $incidents_query->orderBy($sort_by,'ASC');
            }
        }
        $incidents = $incidents_query->paginate(25);

        $departments = Department::all();
        return Inertia::render('Incident/Index', [
            'incidents' => $incidents,
            'departments' => $departments
        ]);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Incident/Create'
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
        Incident::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'content' => $request->name
        ]);
        sleep(1);

        return redirect()->route('incidents.index')->with('message', 'Incident Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        $request = Request::all();
        $incident->load('user');
        $incident->load('department');
        $incident->load('people.institutions');
        if(array_key_exists('current_page',$request)){
            $current_page = $request['current_page'];
        }else{
            $current_page = 1;
        }
        return Inertia::render('Incident/Show', [
            'incident' => $incident,
            'current_page' => $current_page
        ]);
    }

    public function showWithPoi($id){
        $incident = Incident::find($id);
        $incident->load('people');
        $incident->load('user');
        $incident->load('department');
        return Inertia::render('Incident/ShowPoi', [
            'incident' => $incident,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $incident = Incident::find($id);
        $departments = Department::get();
        $incident_departments = array();
        $available_departments = array();
        foreach($departments as $department){
            $available_departments[] = array(
                'id' => $department->id,
                'label' => $department->description
            );
        }
        foreach($incident->departments as $department) {
            $incident_departments[] = $department->id;
        }
        if((Auth::user()->isAdmin())){
            return Inertia::render('Incident/Edit', [
                'available_departments' => $available_departments,
                'incident_departments' => $incident_departments,
                'incident' => $incident,
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
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Incident $incident ){
        $data = $request->all();
        $selected_departments = $data['selected_departments'] ?? [];
        unset($data['incident']);
        unset($data['available_departments']);
        unset($data['selected_departments']);
        $incident->update($data);
        $incident->save();
        $incident->departments()->sync($selected_departments);
        return redirect()->route('incident.edit',$incident)->with('success', 'Incident Updated Successfully');
    }


    public function updateProfilePicture(Request $request ){
        $data = $request->all();
        $incident = Incident::find($request->incident_id);
        if($request->hasFile('profile_picture')){
            $fileName = $incident->id.'_profile_pic.'.$request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move(public_path('incident_files'), $fileName);
        }
        $incident->profile_picture = $fileName;
        $incident->save();
        $request->session()->flash('status', 'Incident updated successfully!');
        return Redirect::route('incident.edit',$incident);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();
        sleep(1);

        return redirect()->route('incidents.index')->with('message', 'Incident Delete Successfully');
    }
}
