<?php

namespace App\Http\Controllers;

use App\Models\RoomPricing;
use Illuminate\Http\Request;

class RoomPricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('room_pricings.index', [
            'room_pricings' => RoomPricing::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('room_pricings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'duration' => 'required',            
            'price' => 'required|numeric'
        ]);        

        RoomPricing::create($formFields);

        return redirect('/room_pricings')->with('message', 'Room Price created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomPricing  $roomPricing
     * @return \Illuminate\Http\Response
     */
    public function show(RoomPricing $roomPricing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomPricing  $roomPricing
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomPricing $roomPricing)
    {
        return view('room_pricings.edit', [
            'room_pricing' => $roomPricing
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomPricing  $roomPricing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomPricing $roomPricing)
    {
        $formFields = $request->validate([
            'duration' => 'required',            
            'price' => 'required|numeric'
        ]); 

        $roomPricing->update($formFields);

        return redirect('/room_pricings')->with('message', 'Room Price updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomPricing  $roomPricing
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomPricing $roomPricing)
    {
        $roomPricing->delete();
        return redirect('/room_pricings')->with('message', 'Room Price deleted successfully');
    }
}
