<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Check-Out {{$room->room_name}}</h5>

                    <form method="POST" action="/checkout/{{$room->id}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Date/Time Check-In</label>
                            <div class="col-sm-10">      
                                @php                                    
                                    date_default_timezone_set('Asia/Manila');
                                @endphp                      
                            <label for="inputEmail3" class="col-sm-3 col-form-label">{{Carbon\Carbon::parse($last_transact->date_time)->format('d/m/Y g:i a')}}</label>                         
                            </div>
                        </div>    
                                             
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Date/Time Check-Out</label>
                            <div class="col-sm-10">      
                                @php                                    
                                    date_default_timezone_set('Asia/Manila');
                                @endphp                      
                            <label for="inputEmail3" class="col-sm-3 col-form-label">{{Carbon\Carbon::parse(now())->format('d/m/Y g:i a')}}</label>                         
                            </div>
                        </div>    
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Duration</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" name="duration" required>
                                <option value="" selected>Select...</option>
                                @foreach ($room_pricings as $item)
                                    <option value="{{$item->duration}}|{{$item->price}}" {{$last_transact->price == $item->price ? 'selected' : ''}}>{{$item->duration}} - {{number_format($item->price,2)}}</option>
                                @endforeach                                
                                </select>
                            </div>
                        </div>
                      
                        <x-form-bottom-buttons submit_txt="Check-Out" />
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>