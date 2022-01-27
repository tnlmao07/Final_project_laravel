@include('includes.header')
@include('includes.sidebar')
<div class="content-wrapper container">
    <div class="card card-dark m-3">
        <div class="card-header">
          <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{$url}}" method="post" >
            @csrf
          <div class="card-body">
                <div class="form-group">
                  <label for="name">Coupon Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Name"
                  @if ($updateToken==true)
                  value="{{$coupon->name}}"
                  @endif  
                    >
                  <span class="text-danger">
                    @error('name')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="description">Coupon Code</label>
                  <input type="text" name="coupon_code" class="form-control" placeholder="Enter Coupon Code" 
                  @if ($updateToken==true)
                  value="{{$coupon->coupon_code}}"
                  @endif  >
                  <span class="text-danger">
                    @error('coupon_code')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                    <label for="description">Discount </label>
                    <input type="text" name="discount" class="form-control" placeholder="Enter Discount" 
                    @if ($updateToken==true)
                    value="{{$coupon->discount}}"
                    @endif  >
                    <span class="text-danger">
                      @error('discount')
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