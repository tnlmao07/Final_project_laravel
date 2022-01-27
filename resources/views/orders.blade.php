@include('includes.header')
@include('includes.sidebar')
<div class="content-wrapper">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Coupon Dashboard</h1>
        </div>
    </div>
    <div class="text-center p-3">
        <a href="/add-coupon"><button class="btn btn-dark">Add Coupon</button></a>
    </div>
    <div id="table">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Product Id</th>
                    <th>Email</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $o)
            <tr>
                <td>{{$o->id}}</td>
                <td>{{$o->name}}</td>
                <td>{{$o->pid}}</td>
                <td>{{$o->uid}}</td>
                <td>{{$o->price}}</td>
                <td>{{$o->quantity}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@include('includes.footer')