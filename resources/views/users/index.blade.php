<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Users</h5>

                    @if(session()->has('message'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <a href="/users/create">
                        <div class="text-end">
                            <button type="button" class="btn btn-primary">Add New</button>       
                        </div>  
                    </a>                                          
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col" colspan="2" class="text-center">Action</th>                            
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($users) == 0)
                        @php
                            $counter = 1;                            
                        @endphp
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td>{{$user->username}}</td>
                                <td class="text-center"><a href="/users/{{$user->id}}/edit"><button type="button" class="btn btn-outline-info btn-sm">Edit</button></a></td>
                                <td class="text-center">
                                    <form method="POST" action="/users/{{$user->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>                                    
                                </td>
                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="3">No User found.</td>
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