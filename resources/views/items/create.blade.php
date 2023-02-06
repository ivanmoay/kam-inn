<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Add Item</h5>

                    <form method="POST" action="/items">
                        @csrf
                     
                        <x-input-text label="Item" main_class="row mb-3" name="item" value="{{old('item')}}"/> 
                        
                        <x-input-text label="Item Price" main_class="row mb-3" name="item_price" value="{{old('item_price')}}"/>  

                        <x-input-text label="Quantity" main_class="row mb-3" name="quantity" value="{{old('quantity')}}"/>  

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