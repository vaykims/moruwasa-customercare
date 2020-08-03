@extends('constants.headerAndSide')


@section('content')
@if(session('info'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{session('info')}}.
    </div>
@endif
@if ($errors->any()) 
    <div class="alert alert-danger alert-dismissible" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
@endif
    <section class="content-header">
      
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">System users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive ">
              <table id="example1" class="table table-bordered table-hover p-3 display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(count($users ?? '') > 0)   
                    @foreach($users ?? ''->all() as $user) 
                <tr>
                    <td>{{ ($user->fname) }}</td>
                    @if($user->mname !== null)
                        <td>{{ ($user->mname) }}</td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ ($user->lname) }}</td>
                    <td>{{ ($user->email) }}</td>
                    <td>{{ ($user->phone) }}</td>
                    <td>{{ ($user->gender) }}</td>
                    <td>{{ ($user->username) }}</td>
                    <td>{{ ($user->role) }}</td>
                    <td >
                        <div class="d-flex justify-content-between">
                            <a href='{{ url("viewUser/{$user->id}") }}' id="update" class="inline-flex float-left text-primary"><i class="fa fa-edit"></i></a>
                            <a href="#" data-toggle="modal" data-target="#{{($user->id)}}" class="inline-flex float-right text-danger" ><i class="fa fa-trash"></i></a>
                        </div>
                    </td>   
                            <!-- Modal -->
                            <div class="modal fade" id="{{($user->id)}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"><em>Deleting User</em></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="bg-light text-center">
                                            <h3>Are sure you want to delete user <em class="text-warning">{{ ($user->fname) }} {{ ($user->lname) }}</em> <i class="fa fa-remove text-danger"></i>?</h3>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <a href='{{ url("deleteUser/{$user->id}") }}' type="button" class="btn btn-danger">Delete</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                        
                </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
        <div class="col-lg-4">
            <div class="addUser" id="register"><a href="#" class="btn btn-primary">add user</a></div>

            <div class="box box-default add" style="display: none;">
                <div class="col-xl-12 jumbotron">
                    <div class="card ">
                            <form method="POST" action="{{ url('/addUser') }}">
                                @csrf


                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ old('fname') }}" 
                                        required autocomplete="fname" autofocus placeholder="First name">

                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">

                                    <div class="col-md-6">
                                        <input id="mname" type="text" class="form-control @error('mname') is-invalid @enderror" name="mname" 
                                        value="{{ old('mname') }}" autocomplete="mname" placeholder="Middle name" >

                                        @error('mname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                            <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname"
                                            value="{{ old('lname') }}" required autocomplete="lname" placeholder="Last name">

                                            @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" placeholder="Email address">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                id="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="+255123456789">
                                        
                                        @error('phone')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" required placeholder="Smith...">
                                        
                                        @error('username')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">

                                    <div class="col-md-6">
                                        <h5 class="info-text"> Select the role </h5>
                                            <select name="role" id="role" class="form-control">
                                                <option value=""> select.. </option>
                                                <option value="admin"> Admin </option>
                                                <option value="agent"> Customer care agent </option>
                                                <option value="manager"> Zone manager </option>
                                            </select>
                                        <div class="custom-control-input  @error('role') is-invalid @enderror col-md-6"></div>
                                        @error('role')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                    <h5 class="info-text"> Select the Gender </h5>
                                            <select name="gender" class="form-control">
                                                <option value=""> choose.. </option>
                                                <option value="M"> Male </option>
                                                <option value="F"> Female </option>
                                            </select>
                                            
                                            <div class="custom-control-input  @error('gender') is-invalid @enderror col-md-6"></div>
                                        @error('gender')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <select name="zone" id="zone" class="form-control">
                                            <option value=""> Select..</option>
                                            <option value="mazimbu"> Mazimbu </option>
                                            <option value="sabasaba">Sabasaba</option>
                                            <option value="msanvu"> Msanvu</option>
                                            <option value="mindu"> Mindu</option>
                                            <option value="boma"> Boma</option>
                                            <option value="kihonda"> Kihonda</option>
                                        </select>
                                        <div class="custom-control-input  @error('zone') is-invalid @enderror col-md-6" value="{{ old('zone') }}"></div>

                                        @error('zone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password" placeholder="password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                        required autocomplete="new-password"  placeholder="confirm password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

      </div>
      <!-- /.row -->
    </section>

@endsection

