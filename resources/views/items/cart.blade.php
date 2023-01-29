<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">cart</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <a href="/cart/create">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary">Add New</button>       
                        </div>  
                    </a>                                          
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"></th>
                            <th scope="col">Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>                        
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($cart) == 0)
                        @php
                            $counter = 1;                            
                        @endphp
                            @foreach ($cart as $cart)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td><a href="#"><button type="button" class="btn btn-outline-danger btn-sm">Remove</button></a></td>
                                <td>{{$cart->name}}</td>
                                <td>{{$cart->qty}}</td>
                                <td>{{$cart->price}}</td>
                                <td>{{$cart->qty * $cart->price}}</td>
                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="6">No cart found.</td>
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