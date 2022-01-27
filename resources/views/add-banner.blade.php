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
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Name"
                  @if ($updateToken==true)
                  value="{{$banner->name}}"
                  @endif  
                    >
                  <span class="text-danger">
                    @error('name')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" name="description" class="form-control" placeholder="Enter description" 
                  @if ($updateToken==true)
                  value="{{$banner->description}}"
                  @endif  >
                  <span class="text-danger">
                    @error('description')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                      <label for="exampleFormControlFile1">Upload Banner Image</label>
                      <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                      <span class="text-danger">
                        @error('file')
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