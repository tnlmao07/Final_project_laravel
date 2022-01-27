@include('includes.header')
@include('includes.sidebar')
<div class="content-wrapper container">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Contact Us Queries</h1>
        </div>
    </div>
    <div id="table">
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Query</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($query as $q)
            <tr>
                <td>{{$q->id}}</td>
                <td>{{$q->name}}</td>
                <td>{{$q->title}}</td>
                <td>{{$q->description}}</td>
                <td>
                    <form method="post" action="{{url('/contact/delete')}}/{{$q->id}}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger  show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                    </form>                
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('includes.footer')