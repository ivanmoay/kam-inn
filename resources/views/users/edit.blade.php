<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Edit {{$user->username}}</h5>

                    <form method="POST" action="/users/{{$user->id}}">
                        @csrf
                        @method('PUT')
                                             
                        {{-- <x-input-text label="Username" main_class="row mb-3" name="username" value="{{$user->username}}"/> --}}

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">                            
                            <input type="password" class="form-control" id="inputText" name="password" value="{{old('password')}}">
                            @error('password')
                                <code>{{$message}}</code>
                            @enderror                            
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Repeat Password</label>
                            <div class="col-sm-10">                            
                            <input type="password" class="form-control" id="inputText" name="password_confirmation">
                            @error('password_confirmation')
                                <code>{{$message}}</code>
                            @enderror                            
                            </div>
                        </div>

                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">User Level</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="userlevel">
                            <option value="1" {{$user->userlevel == 1 ? 'selected' : ''}}>User</option>
                            <option value="2" {{$user->userlevel == 2 ? 'selected' : ''}}>Admin</option>
                            </select>
                        </div>
                        </div>
                      
                        <x-form-bottom-buttons submit_txt="Update" />
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>