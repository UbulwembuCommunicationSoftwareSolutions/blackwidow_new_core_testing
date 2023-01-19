<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Incident;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function PHPUnit\Framework\directoryExists;


class IncidentController extends Controller
{
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $incidents = Incident::all();
            $incidents->load('department');
        }else{
            $incidents = array();
            $departments = Auth::user()->departments;
            foreach($departments as $department){
                foreach($department->incidents as $incident){
                    $incidents[] = $incident->load('department');
                }
            }
        }
        return Inertia::render(
            'Incident/Index',
            [
                'incidents' => $incidents
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
        $institutions = Institution::get();
        $incident_institutions = array();
        $available_institutions = array();
        foreach($institutions as $institution){
            $available_institutions[] = array(
                'id' => $institution->id,
                'label' => $institution->description
            );
        }
        foreach($incident->institutions as $institution) {
            $incident_institutions[] = $institution->id;
        }
        if((Auth::user()->isAdmin())){
            return Inertia::render('Incident/Edit', [
                'available_institutions' => $available_institutions,
                'incident_institutions' => $incident_institutions,
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
        $selected_institutions = $data['selected_institutions'] ?? [];
        unset($data['incident']);
        unset($data['available_institutions']);
        unset($data['selected_institutions']);
        $incident->update($data);
        $incident->save();
        $incident->institutions()->sync($selected_institutions);
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
