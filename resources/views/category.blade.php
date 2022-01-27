@include('includes.header')
@include('includes.sidebar')
   
        <div class="content-wrapper">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">Categories Dashboard</h1>
                </div>
            </div>
            <div class="text-center p-3">
                <a href="/add-category"><button class="btn btn-dark">Add Category</button></a>
            </div>
            <div id="table">
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->name}}</td>
                        <td>{{$c->description}}</td>
                        <td class="row">
                            <form method="post" action="{{url('/category/delete')}}/{{$c->id}}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger  show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                            </form>                            
                            <a href="{{url('category/edit')}}/{{$c->id}}"><button class="btn btn-primary" onclick="myFunction()">Edit</button></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
    </div>
@include('includes.footer')