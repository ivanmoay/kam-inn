<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Edit Item</h5>

                    <form method="POST" action="/items/{{$item->id}}">
                        @csrf
                        @method('PUT')
                                             
                        <x-input-text label="Item" main_class="row mb-3" name="item" value="{{$item->item}}"/>  
                            
                        <x-input-text label="Item Price" main_class="row mb-3" name="item_price" value="{{$item->item_price}}"/> 

                        <div class="form-check">                            
                            <input class="form-check-input" type="checkbox" id="gridCheck1" name="available" {{$item->available == 1 ? 'checked' : ''}}>       
                            <label class="form-check-label" for="gridCheck1">
                                Available
                            </label>                 
                        </div>
                      
                        <x-form-bottom-buttons submit_txt="Update" />
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>