@include('includes.header')
@include('includes.sidebar')
  <!-- Content Wrapper. Contains page content -->
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
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter Name"
                  @if ($updateToken==true)
                  value="{{$user->name}}"
                  @endif  
                    >
                  <span class="text-danger">
                    @error('name')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter Email" 
                  @if ($updateToken==true)
                  value="{{$user->email}}"
                  @endif  >
                  <span class="text-danger">
                    @error('email')
                        {{$message}}
                    @enderror
                  </span>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password"
                    @if ($updateToken==true)
                      value="{{$user->password}}"
                    @endif  >  
                    <span class="text-danger">
                      @error('password')
                          {{$message}}
                      @enderror
                    </span>
                </div>
                <div class="dropdown">
                  <label for="role">Role</label><br>
                  <select id="" name="role">     
                        @foreach ($roles as $r)
                        <option class="dropdown-item" value="{{$r->id}}">{{$r->name}}</option>
                        @endforeach          
                    </select>
                </div> <br>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
          </div>
          <!-- /.card-body -->

          
        </form>
      </div>
  </div>
  <!-- /.content-wrapper -->
@include('includes.footer')