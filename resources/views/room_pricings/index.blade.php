<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Room Prices</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <a href="/room_pricings/create">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary">Add New</button>       
                        </div>  
                    </a>                                          
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Price</th>
                            <th scope="col" colspan="2" class="text-center">Action</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($room_pricings) == 0)
                        @php
                            $counter = 1;                            
                        @endphp
                            @foreach ($room_pricings as $room_pricing)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>{{$room_pricing->duration}}</td>
                                <td>{{$room_pricing->price}}</td>
                                <td class="text-center"><a href="/room_pricings/{{$room_pricing->id}}/edit"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a></td>
                                <td class="text-center">
                                    <form method="POST" action="/room_pricings/{{$room_pricing->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>                                    
                                </td>
                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="4">No Room Pricing found.</td>
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