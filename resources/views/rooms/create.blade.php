<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Add Room</h5>

                    <form method="POST" action="/rooms">
                        @csrf
                     
                        <x-input-text label="Room Name" main_class="row mb-3" name="room_name" value="{{old('room_name')}}"/>   

                        <x-input-text label="Room Number" main_class="row mb-3" name="room_number" value="{{old('room_number')}}"/> 
                        
                        <div class="form-check">                            
                            <input class="form-check-input" type="checkbox" id="gridCheck1" name="available" checked>       
                            <label class="form-check-label" for="gridCheck1">
                                Available
                            </label>                 
                        </div>

                        <x-form-bottom-buttons submit_txt="Create" />
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>