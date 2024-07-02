<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressOptionsRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressOptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Address/add");
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressOptionsRequest $request)
    {
        try {
            $address= new Address;

            $address->user_id = auth()->user()->id;
            $address->addr1 = $request->get('addr1');
            $address->addr2 = $request->get('addr2');
            $address->city = $request->get('city');
            $address->postcode = $request->get('postcode');
            $address->country = $request->get('country');

            // save object
            $address->save();

            return redirect()->route('address.index')->with('success','success');
        
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy(int $id){
        try {
            $address= Address::find($id);
            // save object
            $address->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


 
}
