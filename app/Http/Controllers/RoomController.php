<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rooms.index', [
            'rooms' => Room::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
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
            'room_name' => 'required',            
            'room_number' => 'required'
        ]); 
        
        $formFields['room_name'] = ucwords($formFields['room_name']);

        if(@$request->available == 'on'){
            $formFields['available'] = 1;
        }else{
            $formFields['available'] = 0;
        }

        $formFields['occupied'] = 0;

        Room::create($formFields);

        return redirect('/rooms')->with('message', 'Room created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', [
            'room' => $room
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $formFields = $request->validate([        
            'room_name' => 'required',            
            'room_number' => 'required'
        ]);        

        $formFields['room_name'] = ucwords($formFields['room_name']);

        if(@$request->available == 'on'){
            $formFields['available'] = 1;
        }else{
            $formFields['available'] = 0;
        }

        $room->update($formFields);

        return redirect('/rooms')->with('message', 'Room updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('/rooms')->with('message', 'Room deleted successfully');
    }
}
