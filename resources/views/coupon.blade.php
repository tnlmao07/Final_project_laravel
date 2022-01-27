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
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('message') }}
    </div>
@endif
    <div id="table">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Coupon Code</th>
                    <th>Discount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupon as $c)
            <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->name}}</td>
                <td>{{$c->coupon_code}}</td>
                <td>{{$c->discount}}</td>
                <td class="row">
                    <form method="post" action="{{url('/coupon/delete')}}/{{$c->id}}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger  show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                    </form>                    
                    <a href="{{url('/coupon/edit')}}/{{$c->id}}"><button class="btn btn-primary" onclick="myfunction()">Edit</button></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
</div>
@include('includes.footer')