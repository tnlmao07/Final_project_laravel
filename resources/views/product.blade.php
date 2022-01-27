@include('includes.header')
@include('includes.sidebar')
  <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
       <div class="jumbotron jumbotron-fluid">
           <div class="container">
             <h1 class="display-4">Products Dashboard</h1>
             <p class="lead"></p>
           </div>
       </div>
       <div class="text-center p-2">
           <a href="/add-product"><button class="btn btn-dark">Add Product</button></a>
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
                       <th>Quanity</th>
                       <th>Price</th>
                       <th>Category Name</th>
                       <th>Actions</th>
                       <th>Display Images</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($productData as $p)
               <tr>
                   <td>{{$p->id}}</td>
                   <td>{{$p->name}}</td>
                   <td>{{$p->quantity}}</td>
                   <td>{{$p->price}}</td>
                   <td>{{$p->category_name}}</td>
                   <td class="row">
                    <form method="post" action="{{url('/product/delete')}}/{{$p->id}}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger  show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                    </form>
                    <a href="{{url('product/edit')}}/{{$p->id}}"><button class="btn btn-dark" onclick="myfunction()">Edit</button></a>
                   </td>
                   
                    <td>
                        <a href="{{url('product/display-images')}}/{{$p->id}}"><button class="btn btn-dark" onclick="myfunction()">Images</button></a>
                    </td>
               </tr>
               @endforeach
               </tbody>
             </table>
       </div>
       
   </div>
<!-- /.content-wrapper -->
@include('includes.footer')