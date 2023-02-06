<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use App\Mail\TransactionMail;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

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
            'items' => Item::orderBy('item', 'ASC')->paginate(32),
            'paginated' => true
        ]);
    }

    public function search(Request $request)
    {
        if(empty($request->search)){
            return view('items.index', [
                'items' => Item::orderBy('item', 'ASC')->paginate(32),
                'paginated' => true
            ]);
        }
        return view('items.index', [
            'items' => Item::where('item','like', '%'.$request->search.'%')->orderBy('item', 'ASC')->get(),
            'paginated' => false
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
            'item_price' => 'required|numeric',
            'quantity' => 'required|numeric'
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

    public function addToCart(Item $item)
    {
        Cart::add($item->id, $item->item, 1, $item->item_price, 0);

        return redirect('/items')->with('message', 'Item added to cart.');
    }

    public function cart()
    {
        return view('items.cart', [
            'cart' => Cart::content()
        ]);
    }

    public function removeItemFromCart($rowId)
    {
        Cart::remove($rowId);

        return redirect('/items/cart');
    }

    public function clearCart()
    {
        Cart::destroy();

        return redirect('/items/cart');
    }

    public function checkout(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        
        $total = 0;
        for ($i=0; $i < $request->counter; $i++) { 
            $total += $request->{"total".$i};
        }
        
        if(
            $sale = Sale::create([
                'date_time' => now(),
                'total' => $total,
                //TODO set user_id
                'user_id' => auth()->user()->id
            ])
          )
        {
            for ($i=0; $i < $request->counter; $i++) { 
                if(
                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'item_id' => $request->{"id".$i},
                        'quantity' => $request->{"qty".$i},
                        'price' => $request->{"price".$i},
                        'total' => $request->{"total".$i}
                    ])
                )
                {
                    Item::where('id', '=', $request->{"id".$i})->decrement('quantity', $request->{"qty".$i});
                }
            }
        }

        //email
        $date_time = now();
        $total = $total;
        $user = auth()->user()->username;
        //TODO include items sold
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new TransactionMail($date_time, $total, $user));
        
        Cart::destroy();

        return redirect('/items')->with('message', 'Sale saved.');
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
            'item_price' => 'required|numeric',
            'quantity' => 'required|numeric'
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
