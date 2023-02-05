<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Rooms</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <a href="/rooms/create">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary">Add New</button>       
                        </div>  
                    </a>                                          
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Room Name</th>
                            <th scope="col">Room Number</th>
                            <th scope="col">Available</th>
                            <th scope="col">Occupied</th>
                            <th scope="col" colspan="3" class="text-center">Action</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($rooms) == 0)
                        @php
                            $counter = 1;                            
                        @endphp
                            @foreach ($rooms as $room)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td><a href="/rooms/{{$room->id}}/transactions">{{$room->room_name}}</a></td>
                                <td>{{$room->room_number}}</td>
                                <td>{{$room->available == 1 ? 'Yes' : 'No'}}</td>
                                <td>{{$room->occupied == 1 ? 'Yes' : 'No'}}</td>
                                @if ($room->occupied == 1)
                                    <td class="text-center"><a href="/rooms/{{$room->id}}/checkout"><button type="button" class="btn btn-outline-warning btn-sm">Checkout</button></a></td>
                                @else
                                    <td class="text-center"><a href="/rooms/{{$room->id}}/checkin"><button type="button" class="btn btn-outline-success btn-sm">Checkin</button></a></td>
                                @endif       
                                <td class="text-center"><a href="/rooms/{{$room->id}}/edit"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a></td>                                
                                <td class="text-center">
                                    <form method="POST" action="/rooms/{{$room->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>                                    
                                </td>
                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="6">No Room found.</td>
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