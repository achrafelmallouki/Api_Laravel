<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonResourceCollection;
use App\Person;

class PersonController extends Controller
{
    /**
     * Show c'est pour voir un person avec son ID /person/id 
     *
     * @param Person $person
     * @return PersonResource
     */
    public function show(Person $person) : PersonResource
    {
        return new PersonResource($person);

    }


    /**
     * Index for : Récupérer tous les Champs de la base de données 
     *
     * @return PersonResourceCollection
     */
    public function index():PersonResourceCollection
    {
        return new PersonResourceCollection(Person::paginate());
    }

    public function store(Request $request)
    {
        $request-> validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city' => 'required',

        ]);
        $person = Person::create($request->all());
        return new PersonResource($person);
    }
    /**
     * Undocumented function
     *
     * @param Person $person
     * @param Request $request
     * @return PersonResource
     */
    public function update(Person $person, Request $request) :PersonResource
    {
        $person-> update($request->all());
        return new PersonResource($person);
    }

    /**
     * Undocumented function
     *
     * @param Person $person
     * @return void
     */
    public function destroy(Person $person){
            $person -> delete();
            return response() ->json() ; 

    }
}
