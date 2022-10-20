<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


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
    public function edit(Person $person)
    {
        return Inertia::render(
            'Person/Edit',
            [
                'person' => $person
            ]
        );
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
        $request->session()->flash('status', 'Person updated successfully!');

        $available_institutions = array();
        $person_institutions = array();

        $institutions = Institution::get();
        foreach($institutions as $institution){
            $available_institutions[] =array(
                'id' => $institution->id,
                'label' => $institution->description
            );
        }
        foreach($person->institutions as $institution) {
            $person_institutions[] = $institution->id;
        }
        return Inertia::render('Admin/PersonEdit', [
            'available_institutions' => $available_institutions,
            'person_institutions' => $person_institutions,
            'person' => $person,
            'status' => session('status'),
        ]);

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
