<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cart</h5>

                        @if(session()->has('message'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{session('message')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <a href="/cart/clear">
                            <div class="text-end">
                                <button type="button" class="btn btn-danger">Clear Cart</button>       
                            </div>  
                        </a>  
                        <form method="POST" action="/cart/checkout">
                        @csrf                                      
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>                            
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>     
                                    <th scope="col">Actions</th>                   
                                </tr>
                                </thead>
                                <tbody>                                    
                                @unless (count($cart) == 0)
                                @php
                                    $counter = 0;                            
                                @endphp
                                    @foreach ($cart as $cart)
                                    <tr>
                                        <th scope="row">{{$counter+1}}</th>                                
                                        <td>{{$cart->name}}<input type="hidden" value="{{$cart->id}}" name="id{{$counter}}"><input type="hidden" value="{{$cart->name}}" name="item{{$counter}}"></td>
                                        <td><input type="number" class="form-control" id="qty{{$counter}}" name="qty{{$counter}}" value="{{$cart->qty}}" onchange="getTotal('total{{$counter}}', this.id, 'price{{$counter}}')"></td>
                                        <td><input type="number" class="form-control" id="price{{$counter}}" name="price{{$counter}}" value="{{$cart->price}}" readonly></td>
                                        <td><input type="number" class="form-control" id="total{{$counter}}" name="total{{$counter}}" value="{{$cart->qty * $cart->price}}" readonly></td>
                                        <td><a href="/cart/{{$cart->rowId}}/remove"><button type="button" class="btn btn-outline-danger btn-sm">Remove</button></a></td>
                                    </tr>                                     
                                    @php
                                        $counter++;
                                    @endphp                      
                                    @endforeach 
                                    <tr>
                                        <td colspan="4"></td>
                                        <th scope="row">Total: <span id="total"> 0 </span></th>
                                        <td></td>
                                    </tr>     
                                    <input type="hidden" id="counter" value="{{$counter}}" name="counter">  
                                @else
                                    <tr>
                                        <td colspan="6">No items in cart found.</td>
                                    </tr>  
                                    <p></p>
                                @endunless                                                                  
                                </tbody>
                            </table>
                            @isset($counter)
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="add_to_cart" value="add_to_cart">Checkout</button>
                                </div>
                            @endisset                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            getOverallTotal();

            function getTotal(totalID, qtyID, priceID)
            {
                var quantity = document.getElementById(qtyID).value;
                var price = document.getElementById(priceID).value;                

                document.getElementById(totalID).value = quantity * price;     
                
                getOverallTotal();
            }

            function getOverallTotal()
            {
                var counter = document.getElementById("counter").value;
                var total = 0;

                for (let i = 0; i < counter; i++) {
                    var name = "total" + i;
                    //console.log(name);
                    //console.log(document.getElementById(name).value);

                    total += parseInt(document.getElementById(name).value);
                }                

                var span = document.getElementById("total");
                span.textContent = total;
            }
        </script>
    </section>
</x-layout>