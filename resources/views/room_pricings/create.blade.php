<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Add Room Price</h5>

                    <form method="POST" action="/room_pricings">
                        @csrf
                     
                        <x-input-text label="Duration" main_class="row mb-3" name="duration" value="{{old('duration')}}"/>   

                        <x-input-text label="Price" main_class="row mb-3" name="price" value="{{old('price')}}"/>
                        
                        <x-form-bottom-buttons submit_txt="Create" />
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>