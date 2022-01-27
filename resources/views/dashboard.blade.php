@include('includes.header')
@include('includes.sidebar')
  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <div class="jumbotron jumbotron-fluid">
           <div class="container">
             <h1 class="display-4">Users Dashboard</h1>
             <p class="lead"></p>
           </div>
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
       <div class="text-center p-2">
           <a href="/add-user"><button class="btn btn-dark">Add User</button></a>
       </div>
       <div id="table">
           <table class="table table-striped table-dark">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Name</th>
                       <th>Email</th>
                       <th>Role</th>
                       <th>Actions</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($users as $u)
               <tr>
                   <td>{{$u->id}}</td>
                   <td>{{$u->name}}</td>
                   <td>{{$u->email}}</td>
                   @if ($u->role_id==1)
                   <td>Super Admin</td>
                   @endif
                   @if ($u->role_id==2)
                   <td>Admin</td>
                   @endif
                   @if ($u->role_id==3)
                   <td>Inventory Manager</td>
                   @endif
                   @if ($u->role_id==4)
                   <td>Order Manager</td>
                   @endif
                   @if ($u->role_id==5)
                   <td>Customer</td>
                   @endif
                   
                   <td class="row">
                    <form method="post" action="{{url('/user-management/delete')}}/{{$u->id}}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger  show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                    </form>                       
                    <a href="{{url('user-management/edit')}}/{{$u->id}}"><button class="btn btn-dark" onclick="myfunction()">Edit</button></a>
                   </td>
               </tr>
               @endforeach
               </tbody>
             </table>
       </div>
       
   </div>
<!-- /.content-wrapper -->
@include('includes.footer')