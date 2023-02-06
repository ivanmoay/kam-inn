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
                        @endphp
                            @foreach ($item_sales as $item_sale)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>{{$item_sale->sale_id}}</td>
                                <td>{{Carbon\Carbon::parse($item_sale->created_at)->format('d/m/Y g:i a')}}</td>
                                <td>{{$item_sale->items->item}}</td>
                                <td>{{$item_sale->quantity}}</td>
                                <td>₱ {{number_format($item_sale->price,2)}}</td>
                                <td>₱ {{number_format($item_sale->total,2)}}</td>
                                <td>{{$item_sale->sales->users->username}}</td>
                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="6">No Item Sales found.</td>
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