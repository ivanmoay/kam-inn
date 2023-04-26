<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Mail\RoomMail;
use App\Models\SaleItem;
use App\Models\RoomPricing;
use Illuminate\Http\Request;
use App\Models\RoomTransaction;
use Illuminate\Support\Facades\Mail;

class RoomController extends Controller
{
    public function index()
    {
        return view('rooms.index', [
            'rooms' => Room::all()
        ]);
    }

    public function transactions(Room $room)
    {
        return view('rooms.transactions', [
            'room' => $room,
            'room_transactions' => RoomTransaction::where('room_id', $room->id)->orderBy('date_time', 'DESC')->paginate(64)
        ]);
    }

    public function room_transactions(Request $request)
    {
        $from = $request->dateFrom.' '.$request->timeFrom;
        $to = $request->dateTo.' '.$request->timeTo;

        return view('rooms.room_transactions', [
            'room_transactions' => RoomTransaction::whereBetween('date_time', [$from, $to])->orderBy('date_time', 'DESC')->get(),
            'dateFrom' => $request->dateFrom,
            'dateTo' => $request->dateTo,
            'timeFrom' => $request->timeFrom,
            'timeTo' => $request->timeTo,
            'user_id' => $request->user_id,
            'users' => User::all()
        ]);
    }

    public function summaryView(){
        return view('summary', [
            'users' => User::all()
        ]);
    }

    public function summary(Request $request){
        $from = $request->dateFrom.' '.$request->timeFrom;
        $to = $request->dateTo.' '.$request->timeTo;

        $by = User::where('id', $request->user_id)->first();        

        return view('summary', [
            'item_sales' => SaleItem::whereBetween('created_at', [$from, $to])->orderBy('created_at', 'DESC')->get(),
            'room_transactions' => RoomTransaction::whereBetween('date_time', [$from, $to])->orderBy('date_time', 'DESC')->get(),
            'dateFrom' => $request->dateFrom,
            'dateTo' => $request->dateTo,
            'timeFrom' => $request->timeFrom,
            'timeTo' => $request->timeTo,
            'user_id' => $request->user_id,
            'users' => User::all(),
            'by' => $by,
        ]);
    }

    public function create()
    {
        return view('rooms.create');
    }

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

    public function checkinShow(Room $room)
    {
        return view('rooms.room_checkin', [
            'room' => $room,
            'room_pricings' => RoomPricing::all()
        ]);
    }

    public function checkoutShow(Room $room)
    {
        return view('rooms.room_checkout', [
            'room' => $room,
            'room_pricings' => RoomPricing::all(),
            'last_transact' => RoomTransaction::where('room_id', '=', $room->id)->where('transact_type', '=', 'in')->latest()->first()
        ]);
    }

    public function extendShow(Room $room)
    {
        return view('rooms.room_extend', [
            'room' => $room,
            'room_pricings' => RoomPricing::all(),
            'last_transact' => RoomTransaction::where('room_id', '=', $room->id)->where('transact_type', '=', 'in')->latest()->first()
        ]);
    }

    public function checkin(Request $request, Room $room)
    {
        date_default_timezone_set('Asia/Manila');
        //update room occupied
        if(Room::where('id', $room->id)->update(['occupied' => 1]))
        {
            //save room transaction
            $split = explode("|", $request->duration);

            RoomTransaction::create([
                'room_id' => $room->id,
                'duration' => $split[0],
                'price' => $split[1],
                'date_time' => now(),
                'transact_type' => 'in',
                'user_id' => auth()->user()->id
            ]);

            //email
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new RoomMail('in', $room->room_name, $room->room_number, $split[0], $split[1], now(), auth()->user()->username));
        }

        return redirect('/rooms')->with('message', 'Room booked.');       
    }

    public function checkout(Request $request, Room $room)
    {
        date_default_timezone_set('Asia/Manila');
        //update room occupied
        if(Room::where('id', $room->id)->update(['occupied' => 0]))
        {
            //save room transaction
            $split = explode("|", $request->duration);

            RoomTransaction::create([
                'room_id' => $room->id,
                'duration' => $split[0],
                'price' => $split[1],
                'date_time' => now(),
                'transact_type' => 'out',
                'user_id' => auth()->user()->id
            ]);

            //email
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new RoomMail('out', $room->room_name, $room->room_number, $split[0], $split[1], now(), auth()->user()->username));
        }

        return redirect('/rooms')->with('message', 'Room checkout.'); 
    }

    public function extend(Request $request, Room $room)
    {
        date_default_timezone_set('Asia/Manila');
        //update room occupied
        // if(Room::where('id', $room->id)->update(['occupied' => 0]))
        // {
        //save room transaction
        $split = explode("|", $request->duration);

        RoomTransaction::create([
            'room_id' => $room->id,
            'duration' => $split[0],
            'price' => $split[1],
            'date_time' => now(),
            'transact_type' => 'ext',
            'user_id' => auth()->user()->id
        ]);

        //email
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new RoomMail('ext', $room->room_name, $room->room_number, $split[0], $split[1], now(), auth()->user()->username));
        // }

        return redirect('/rooms')->with('message', 'Room Stay Extended.'); 
    }

    public function edit(Room $room)
    {        
        return view('rooms.edit', [
            'room' => $room
        ]);
    }

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

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect('/rooms')->with('message', 'Room deleted successfully');
    }

    public function void(RoomTransaction $room_transaction){
        $room_id = $room_transaction->room_id;
        $transact_type = $room_transaction->transact_type;
        //dd($room_transaction);
        $room_transaction->delete();
        if($transact_type == 'in'){
            Room::where('id', $room_id)->update(['occupied' => 0]);
        }else{
            Room::where('id', $room_id)->update(['occupied' => 1]);
        }
        return redirect('/rooms/'.$room_id.'/transactions')->with('message', 'Room transaction voided.');
    }
}
