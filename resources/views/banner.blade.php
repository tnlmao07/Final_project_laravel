
@include('includes.header')
@include('includes.sidebar')
   
        <div class="content-wrapper">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">Banner Dashboard</h1>
                </div>
            </div>
            <div class="text-center p-3">
                <a href="/add-banner"><button class="btn btn-dark">Add Banner</button></a>
            </div>
            <div id="table">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $b)
                    <tr>
                        <td>{{$b->id}}</td>
                        <td>{{$b->name}}</td>
                        <td>{{$b->description}}</td>
                        <td><img src="{{$b->image}}" alt="noimage"></td>
                        <td class="row">

                            <form method="post" action="{{url('/banner/delete')}}/{{$b->id}}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger  show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                            </form>
                           <a href="{{url('/banner/edit')}}/{{$b->id}}"><button class="btn btn-primary" onclick="myFunction()">Edit</button></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@include('includes.footer')
