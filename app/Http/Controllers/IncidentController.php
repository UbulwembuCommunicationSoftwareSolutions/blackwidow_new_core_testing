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
        return Inertia::render(
            'Incident/Index'
        );
    }

    public function ajaxIncidents(){
        $request = Request::all();
        $search = false;
        if(array_key_exists('search',$request)){
            if(strlen($request['search'])>0){
                $search = $request['search'];
            }
        }
        if(Auth::user()->isAdmin()){
            $incidents = Incident::query();
        }else{
            $incidents = array();
            $departments = Auth::user()->departments;
        }
        $array = array();
        if($search){
            $incidents
                ->where('description', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                ->get();
        }else{
            $incidents->get();
        }

        $incidents->load('department');
        $incidents->load('user');
        foreach($incidents as $incident){
            $array[] = array(
                "id" => $incident->id,
                "description" => $incident->description,
                "user" =>   $incident->user->first_name." ".$incident->user->surname,
                "created" => $incident->created_at->format('Y-m-d H:i:s')
            );
        }
        return json_encode($array);
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
        //
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
