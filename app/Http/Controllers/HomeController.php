<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class HomeController extends Controller
{
    public function showDashBoard()
    {
        $markers = array();
        $user_id = Auth::user()->id;
        if(Auth::user()->isAdmin()){
            $marker_incidents = Incident::get();
            $departments = Department::withCount('incidents')
                ->get();

        }else{
            $marker_incidents = Incident::where('user_id',$user_id)
                ->take(20)
                ->orderBy('created_at','DESC')
                ->get();
            $departments = Department::withCount('incidents')
                ->WhereHas('incidents', function ($query) use ($user_id)  {
                    $query->where('user_id', $user_id);
                })->get();
        }

        foreach($marker_incidents as $incident){
             $markers[] = array(
                     "position" => array(
                         "lat" => floatval($incident->gps_lat),
                         "lng"=> floatval($incident->gps_lng),
                     ),
                    "href" => '/incident/'.$incident->id,
                    "text" => 'Case nr: '.$incident->id
             );
        }

        if(Auth::user()->isAdmin()){
            $incident_pending = Incident::where('incident_status_id','1')
                ->count();
            $incident_referred = Incident::where('incident_status_id','2')
                ->count();
            $incident_closed= Incident::where('incident_status_id','3')
                ->count();

        }else{
            $incident_pending = Incident::where('user_id',$user_id)
                ->where('incident_status_id','1')
                ->count();
            $incident_referred = Incident::where('user_id',$user_id)
                ->where('incident_status_id','2')
                ->count();
            $incident_closed= Incident::where('user_id',$user_id)
                ->where('incident_status_id','3')
                ->count();
        }

        $incident_stats = array(
            "pending" => $incident_pending,
            "referred" => $incident_referred,
            "closed" => $incident_closed,
        );

        return Inertia::render(
            'Dashboard/Index',
            [
                'incident_stats' => $incident_stats,
                'markers' => $markers,
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
