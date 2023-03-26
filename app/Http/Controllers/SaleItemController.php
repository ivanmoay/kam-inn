<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.item_sales', [
            'item_sales' => SaleItem::orderBy('created_at', 'DESC')->paginate(64),
            'users' => User::all()
        ]);
    }

    public function filter(Request $request)
    {
        //dd($request->dateFrom.' '.$request->timeFrom);
        $from = $request->dateFrom.' '.$request->timeFrom;
        $to = $request->dateTo.' '.$request->timeTo;
        if($request->user_id == 0){
            $item_sales = SaleItem::whereBetween('created_at', [$from, $to])->orderBy('created_at', 'DESC')->get();
        }else{
            $item_sales = SaleItem::whereBetween('created_at', [$from, $to])->orderBy('created_at', 'DESC')->get();
        }        

        return view('sales.item_sales', [
            'item_sales' => $item_sales,
            'dateFrom' => $request->dateFrom,
            'dateTo' => $request->dateTo,
            'timeFrom' => $request->timeFrom,
            'timeTo' => $request->timeTo,
            'user_id' => $request->user_id,
            'users' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function show(SaleItem $saleItem)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleItem $saleItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleItem $saleItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleItem $saleItem)
    {
        //
    }
}
