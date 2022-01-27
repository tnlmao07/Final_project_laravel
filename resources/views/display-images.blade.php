@include('includes.header')
@include('includes.sidebar')
<div class="content-wrapper">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Product Images</h1>
        </div>
    </div>
    
    <div class="container row ">
        @foreach ($images as $i)
        <div class="card " style="width: 18rem; margin:10px;">
            <img class="card-img-top" src="/uploads/{{$i->image_name}}" alt="Card image cap">
        </div>
        @endforeach
    </div>
    
    
</div>
@include('includes.footer')
