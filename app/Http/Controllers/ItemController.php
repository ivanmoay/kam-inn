<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('items.index', [
            'items' => Item::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
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
            'item' => 'required',            
            'item_price' => 'required|numeric'
        ]); 
        
        $formFields['item'] = ucwords($formFields['item']);

        if(@$request->available == 'on'){
            $formFields['available'] = 1;
        }else{
            $formFields['available'] = 0;
        }

        Item::create($formFields);

        return redirect('/items')->with('message', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $formFields = $request->validate([        
            'item' => 'required',            
            'item_price' => 'required|numeric'
        ]);        

        $formFields['item'] = ucwords($formFields['item']);

        if(@$request->available == 'on'){
            $formFields['available'] = 1;
        }else{
            $formFields['available'] = 0;
        }

        $item->update($formFields);

        return redirect('/items')->with('message', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect('/items')->with('message', 'Item deleted successfully');
    }
}
