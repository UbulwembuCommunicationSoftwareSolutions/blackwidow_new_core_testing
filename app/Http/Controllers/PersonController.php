<?php

namespace App\Http\Controllers;

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
        if(Auth::user()->isAdmin()){
            $people = Person::all();
            $people->load('institutions');
        }else{
            $people = array();
            $institutions = Auth::user()->institutions;
            foreach($institutions as $institution){
                foreach($institution->people as $person){
                    $people[] = $person->load('institutions');
                }
            }
        }

        return Inertia::render(
            'Person/Index',
            [
                'people' => $people
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
        $person = Person::find($id);
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
        if((Auth::user()->isAdmin())){
            return Inertia::render('Person/Edit', [
                'available_institutions' => $available_institutions,
                'person_institutions' => $person_institutions,
                'person' => $person,
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
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person ){
        $data = $request->all();
        $selected_institutions = $data['selected_institutions'] ?? [];
        unset($data['person']);
        unset($data['available_institutions']);
        unset($data['selected_institutions']);
        $person->update($data);
        $person->save();
        $person->institutions()->sync($selected_institutions);
        return redirect()->route('person.edit')->with('message', 'Person Updated Successfully');
    }


    public function updateProfilePicture(Request $request, Person $person ){
        $data = $request->all();
        if($request->hasFile('file_upload')){
            $fileName = time().'.'.$request->file->getClientOriginalExtension();
            if(!directoryExists(public_path('person'))){
                mkdir(public_path('person'));
            }
            $request->file->move(public_path('person'), $fileName);
        }
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
