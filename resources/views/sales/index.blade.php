<x-layout>
    <div class="pagetitle">
        <h1></h1>
    </div>

    <section class="section">
        <div class="row">            

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Sales</h5>

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
                            <th scope="col">Sale ID</th>
                            <th scope="col">Date/Time</th>
                            <th scope="col">Total</th>
                            <th scope="col">Sold by</th>
                     
                        </tr>
                        </thead>
                        <tbody>
                        @unless (count($sales) == 0)
                        @php
                            $counter = 1;                            
                        @endphp
                            @foreach ($sales as $sale)
                            <tr>
                                <th scope="row">{{$counter++}}</th>
                                <td><a href="/sales/{{$sale->id}}/items">{{$sale->id}}</a></td>
                                <td>{{Carbon\Carbon::parse($sale->date_time)->format('d/m/Y h:m A')}}</td>
                                <td>₱ {{number_format($sale->total,2)}}</td>
                                <td>{{@$sale->users->username}}</td>

                            </tr>                             
                            @endforeach     
                        @else
                            <tr>
                                <td colspan="6">No sale found.</td>
                            </tr>  
                            <p></p>
                        @endunless                                                                  
                        </tbody>
                    </table>
                    {{$sales->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>