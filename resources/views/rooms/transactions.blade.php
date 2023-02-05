<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Room Transactions</h5>

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
                            <th scope="col">Room</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Price</th>
                            <th scope="col">Type</th>
                            <th scope="col">Date Time</th>  
                            <th scope="col">By</th>                     
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($room_transactions) == 0)
                        @php
                            $counter = 1;                            
                        @endphp
                            @foreach ($room_transactions as $room_transaction)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>{{$room->room_name}}|{{$room->room_number}}</td>
                                <td>{{$room_transaction->duration}}</td>
                                <td>{{number_format($room_transaction->price,2)}}</td>
                                <td>{{strtoupper($room_transaction->transact_type)}}</td>
                                <td>{{Carbon\Carbon::parse($room_transaction->date_time)->format('d/m/Y g:i a')}}</td>
                                <td>{{$room_transaction->users->username}}</td>
                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="6">No Room Transactions found.</td>
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