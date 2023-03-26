<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Transaction Summary</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif  
                    
                    <form method="POST" action="/summary" class="row g-3">
                    @csrf
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">From</label>
                            <input type="date" class="form-control" name="dateFrom" value="{{@$dateFrom}}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">Time</label>
                            <input type="time" class="form-control" name="timeFrom" value="{{@$timeFrom}}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">To</label>
                            <input type="date" class="form-control" name="dateTo" value="{{@$dateTo}}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">Time</label>
                            <input type="time" class="form-control" name="timeTo" value="{{@$timeTo}}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">By</label>
                            <select class="form-select" aria-label="Default select example" name="user_id">
                                <option value="0" selected>All</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{@$user_id==$user->id ? 'selected' : ''}}>{{$user->username}}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="inputPassword5" class="form-label">&nbsp;</label><br/>
                            {{-- <input type="password" class="form-control" id="inputPassword5"> --}}
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>  

                    <div style="margin-top: 2rem;">
                        @php
                            $totalSales = 0;
                            $totalRoomTransactions = 0;

                            if(!empty($item_sales)){
                                foreach ($item_sales as $item_sale){
                                    if ($user_id > 0){
                                        if ($user_id == @$item_sale->sales->user_id){
                                            $totalSales += $item_sale->total;       
                                        }      
                                    }                                                                 
                                    else{
                                        $totalSales += $item_sale->total;
                                    }                                    
                                }
                            }
                            
                            if(!empty($item_sales)){
                                foreach (@$room_transactions as $room_transaction){
                                    if ($user_id > 0){
                                        if ($user_id == @$room_transaction->user_id){                                        
                                            if($room_transaction->transact_type != 'out')
                                            {
                                                $totalRoomTransactions += $room_transaction->price;       
                                            }
                                        }  
                                    }                          
                                    else{                                    
                                        if($room_transaction->transact_type != 'out')
                                        {
                                            $totalRoomTransactions += $room_transaction->price;       
                                        }     
                                    }                                                  
                                }
                            }
                            //dd($by);
                        @endphp
                        <h2>From: {{@$dateFrom.' '.@$timeFrom}} To: {{@$dateTo.' '.@$timeTo}}</h2>
                        <h2>Total Sales: ₱ {{@number_format($totalSales,2)}}</h2>
                        <h2>Total Room Transactions: ₱ {{@number_format($totalRoomTransactions,2)}}</h2>
                        <h2>By: {{!empty($by->username) ? $by->username : 'All'}}</h2>
                    </div>
                    
                                        
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>