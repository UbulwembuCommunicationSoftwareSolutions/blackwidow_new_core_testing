<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function PHPUnit\Framework\directoryExists;


class PersonController extends Controller
{
    public function index()
    {
        $request = \Illuminate\Support\Facades\Request::all();
        $search = false;
        if(array_key_exists('search',$request)){
            if(strlen($request['search'])>0){
                $search = $request['search'];
            }
        }
        if(Auth::user()->isAdmin()){
            $people_query = Person::query();
        }else{
            $people_query = Person::query();
        }
        $people_query->with('institutions');
        if($search){
            $people_query
                ->where('people.first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('people.id', 'LIKE', '%' . $search . '%')
                ->orWhere('people.surname', 'LIKE', '%' . $search . '%')
                ->orWhere('people.created_at', 'LIKE', '%' . $search . '%')
                ->orWhereHas('institutions', function ($query) use ($search)  {
                    $query->where('description', 'like', '%'.$search.'%');
                });
        }

        $people = $people_query->paginate(50);

        return Inertia::render('Person/Index', [
            'people' => $people,
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
            'Person/Create'
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
        Person::create([
            'title' => $request->title,
            'slug' => \Str::slug($request->slug),
            'content' => $request->name
        ]);
        sleep(1);

        return redirect()->route('persons.index')->with('message', 'Person Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return Inertia::render('Person/Show', [
            'person' => $person,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $person = Person::find($id);
        $incidents = $person->incidents;
        $incidents->load('user');
        $institutions = Institution::get();
        $person_institutions = array();
        $available_institutions = array();
        foreach($institutions as $institution){
            $available_institutions[] = array(
                'id' => $institution->id,
                'label' => $institution->description
            );
        }
        foreach($person->institutions as $institution) {
            $person_institutions[] = $institution->id;
        }
        $permissions = Auth::user()->getPermissions();

        if((Auth::user()->isAdmin())){
            return Inertia::render('Person/Edit', [
                'available_institutions' => $available_institutions,
                'person_institutions' => $person_institutions,
                'person' => $person,
                'incidents' => $incidents,
                "permissions" => $permissions,
                'status' => session('status'),
            ]);
        }else{
            if (in_array("person_view", $permissions)) {
                return Inertia::render('Person/Edit', [
                    'available_institutions' => $available_institutions,
                    'person_institutions' => $person_institutions,
                    'person' => $person,
                    'incidents' => $incidents,
                    "permissions" => $permissions,
                    'status' => session('status'),
                ]);
            }else{
                return Inertia::render('Unauthorised', [
                    'status' => session('status'),
                ]);
            }

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person ){
        $data = $request->all();
        $selected_institutions = $data['selected_institutions'] ?? [];
        $person->update($data['person']);
        $person->save();
        $person->institutions()->sync($selected_institutions);
        return redirect()->route('person.edit',$person)->with('success', 'Person Updated Successfully');
    }


    public function updateProfilePicture(Request $request ){
        $data = $request->all();
        $person = Person::find($request->object_id);
        if($request->hasFile('profile_picture')){
            $fileName = $person->id.'_profile_pic.'.$request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->move(public_path('person_files'), $fileName);
            $person->profile_picture = $fileName;
        }
        $person->save();
        $request->session()->flash('status', 'Person updated successfully!');
        return Redirect::route('person.edit',$person);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();
        sleep(1);

        return redirect()->route('persons.index')->with('message', 'Person Delete Successfully');
    }
}
