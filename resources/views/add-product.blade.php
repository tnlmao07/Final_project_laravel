@include('includes.header')
@include('includes.sidebar')
<div class="content-wrapper container">
    <div class="card card-dark m-3">
        <div class="card-header">
          <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{$url}}" method="post" enctype="multipart/form-data">
            @csrf
              
          <div class="card-body">
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" name="product_name" class="form-control" placeholder="Enter Name"
                  @if ($updateToken==true)
                  value="{{$product_name}}"
                   
                   @endif >
                  <span class="text-danger">
                    @error('product_name')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="product_description">Product Description</label>
                  <input type="text" name="product_description" class="form-control" placeholder="Enter description" 
                  @if ($updateToken==true)
                  value="{{$product_description}}"
                  @endif  >
                  <span class="text-danger">
                    @error('product_description')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="product_quantity">Product Quantity</label>
                  <input type="number" name="product_quantity" class="form-control" placeholder="Enter Quantity" 
                  @if ($updateToken==true)
                  value="{{$product_quantity}}"
                  @endif  >
                  <span class="text-danger">
                    @error('product_quantity')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="product_price">Product Price</label>
                  <input type="number" name="product_price" class="form-control" placeholder="Enter Price" 
                  @if ($updateToken==true)
                  value="{{$product_price}}"
                  @endif  >
                  
                  <span class="text-danger">
                    @error('product_price')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                
                  
                <div class="dropdown">
                    <label for="category">Category</label><br>
                    <select id="" name="category">     
                          @foreach ($category as $c)
                                <option class="dropdown-item" value="{{$c->id}}">{{$c->name}}</option>
                          @endforeach          
                    </select>
                    <span class="text-danger">
                      @error('category')
                          {{$message}}
                      @enderror
                    </span>
                </div> <br>
                <div class="form-group">
                  <label for="images">Product Images</label>
                  <input type="file" name="images[]" multiple class="form-control">
                  <span class="text-danger">
                    @error('images')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
          </div>
       
          <!-- /.card-body -->
        </form>
      </div>
  </div>
@include('includes.footer')