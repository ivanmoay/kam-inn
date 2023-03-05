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
                    
                    <form method="POST" action="/rooms/transactions" class="row g-3">
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
                            <label for="inputEmail5" class="form-label">By</label>
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
                                @if (@$user_id > 0)
                                    @if ($user_id == @$room_transaction->user_id)
                                        <tr>
                                            <th scope="row">{{$counter++}}</th>
                                            <td>{{$room_transaction->rooms->room_name}}|{{$room_transaction->rooms->room_number}}</td>
                                            <td>{{$room_transaction->duration}}</td>
                                            <td>{{number_format($room_transaction->price,2)}}</td>
                                            <td>{{strtoupper($room_transaction->transact_type)}}</td>
                                            <td>{{Carbon\Carbon::parse($room_transaction->date_time)->format('d/m/Y g:i a')}}</td>
                                            <td>{{@$room_transaction->users->username}}</td>
                                        </tr> 
                                    @endif                                
                                @else
                                    <tr>
                                        <th scope="row">{{$counter++}}</th>
                                        <td>{{$room_transaction->rooms->room_name}}|{{$room_transaction->rooms->room_number}}</td>
                                        <td>{{$room_transaction->duration}}</td>
                                        <td>{{number_format($room_transaction->price,2)}}</td>
                                        <td>{{strtoupper($room_transaction->transact_type)}}</td>
                                        <td>{{Carbon\Carbon::parse($room_transaction->date_time)->format('d/m/Y g:i a')}}</td>
                                        <td>{{@$room_transaction->users->username}}</td>
                                    </tr> 
                                @endif                                                        
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="7">No Room Transactions found.</td>
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