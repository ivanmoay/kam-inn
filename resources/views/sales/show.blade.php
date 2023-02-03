<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Sale #{{$saleItems->first()->sale_id}}</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                     
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($saleItems) == 0)
                        @php
                            $counter = 1;         
                            $total = 0;                   
                        @endphp
                            @foreach ($saleItems as $saleItem)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>{{$saleItem->items->item}}</td>
                                <td>{{$saleItem->quantity}}</td>
                                <td>₱ {{number_format($saleItem->price,2)}}</td>
                                <td>₱ {{number_format($saleItem->total,2)}}</td>
                            </tr>                  
                            @php
                                $total += $saleItem->total;
                            @endphp           
                            @endforeach 
                            <tr>
                                <td colspan="4"></td>
                                <th scope="row">Total: {{number_format($total,2)}}</th>
                            </tr>         
                        @else
                            <tr>
                                <td colspan="6">No sale found found.</td>
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