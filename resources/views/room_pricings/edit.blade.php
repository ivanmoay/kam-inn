<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Edit Room Price</h5>

                    <form method="POST" action="/room_pricings/{{$room_pricing->id}}">
                        @csrf
                        @method('PUT')
                                             
                        <x-input-text label="Duration" main_class="row mb-3" name="duration" value="{{$room_pricing->duration}}"/> 
                         
                        <x-input-text label="Price" main_class="row mb-3" name="price" value="{{$room_pricing->price}}"/> 
                      
                        <x-form-bottom-buttons submit_txt="Update" />
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>