<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Items</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <a href="/items/create">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary">Add New</button>       
                        </div>  
                    </a>     

                    <form method="POST" action="/items/search" class="row g-3">
                    @csrf
                        <div class="col-md-3">
                            {{-- <label for="inputEmail5" class="form-label">Email</label> --}}
                            <input type="text" class="form-control" name="search" placeholder="Search Item">
                        </div>
                        <div class="col-md-3">
                            {{-- <label for="inputPassword5" class="form-label">Password</label> --}}
                            {{-- <input type="password" class="form-control" id="inputPassword5"> --}}
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>   

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Add to Cart</th>
                            <th scope="col">Item</th>
                            <th scope="col">Price</th>
                            <th scope="col">Available</th>
                            <th scope="col" colspan="2" class="text-center">Action</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($items) == 0)
                        @php
                            $counter = 1;                            
                        @endphp
                            @foreach ($items as $item)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>
                                    @if ($item->available == 1)
                                        <a href="/items/{{$item->id}}/add_to_cart"><i class="bi bi-cart"></i><a href="#">
                                    @endif                                                                            
                                </td>
                                <td>{{$item->item}}</td>
                                <td>₱ {{number_format($item->item_price, 2)}}</td>
                                <td>{{$item->available == 1 ? 'Yes' : 'No'}}</td>
                                <td class="text-center"><a href="/items/{{$item->id}}/edit"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a></td>
                                <td class="text-center">
                                    <form method="POST" action="/items/{{$item->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>                                    
                                </td>
                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="6">No item found.</td>
                            </tr>  
                            <p></p>
                        @endunless                                                                  
                        </tbody>
                    </table>
                    @if ($paginated)
                        {{$items->links()}}
                    @endif                    
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>