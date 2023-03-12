<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Item Sales</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="/item_sales" class="row g-3">
                    @csrf
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">From</label>
                            <input type="date" class="form-control" name="dateFrom" value="{{@$dateFrom}}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">To</label>
                            <input type="date" class="form-control" name="dateTo" value="{{@$dateTo}}" required>
                        </div>
                        <div class="col-md-2">
                            <label for="inputEmail5" class="form-label">Sold By</label>
                            <select class="form-select" aria-label="Default select example" name="user_id">
                                <option value="0" selected>All</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{@$user_id==$user->id ? 'selected' : ''}}>{{$user->username}}</option>
                                @endforeach                                
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="inputPassword5" class="form-label">&nbsp;</label><br/>
                            {{-- <input type="password" class="form-control" id="inputPassword5"> --}}
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>   

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Sale ID</th>
                            <th scope="col">Date/Time</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>   
                            <th scope="col">Sold by</th>                     
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($item_sales) == 0)
                        @php
                            $counter = 1;          
                            $total = 0;                    
                        @endphp
                            @foreach ($item_sales as $item_sale)
                                @if (@$user_id > 0)
                                    @if ($user_id == @$item_sale->sales->user_id)
                                        <tr>
                                            <th scope="row">{{$counter++}}</th>
                                            <td>{{$item_sale->sale_id}}</td>
                                            <td>{{Carbon\Carbon::parse($item_sale->created_at)->format('d/m/Y g:i a')}}</td>
                                            <td>{{$item_sale->items->item}}</td>
                                            <td>{{$item_sale->quantity}}</td>
                                            <td>₱ {{number_format($item_sale->price,2)}}</td>
                                            <td>₱ {{number_format($item_sale->total,2)}}</td>
                                            <td>{{@$item_sale->sales->users->username}}</td>
                                        </tr> 
                                        @php
                                            $total += $item_sale->total;       
                                        @endphp
                                    @endif                                    
                                @else
                                    <tr>
                                        <th scope="row">{{$counter++}}</th>
                                        <td>{{$item_sale->sale_id}}</td>
                                        <td>{{Carbon\Carbon::parse($item_sale->created_at)->format('d/m/Y g:i a')}}</td>
                                        <td>{{$item_sale->items->item}}</td>
                                        <td>{{$item_sale->quantity}}</td>
                                        <td>₱ {{number_format($item_sale->price,2)}}</td>
                                        <td>₱ {{number_format($item_sale->total,2)}}</td>
                                        <td>{{@$item_sale->sales->users->username}}</td>
                                    </tr>
                                    @php
                                        $total += $item_sale->total;       
                                    @endphp 
                                @endif                                                        
                            @endforeach 
                            <tr>
                                <td colspan="5"></td>
                                <td colspan="1" class="text-end fw-bold">Total:</td>
                                <td colspan="2" class="text-start fw-bold">₱ {{number_format($total,2)}}</td>
                            </tr>    
                        @else
                            <tr>
                                <td colspan="8">No Item Sales found.</td>
                            </tr>  
                            <p></p>
                        @endunless                                                                  
                        </tbody>
                    </table>                 
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>