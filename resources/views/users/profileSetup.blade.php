@extends('constants.headerAndSide')

@section('content')

<div class="container-fluid">
<!-- success alert -->
@if(session('info'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{session('info')}}.
    </div>
<!-- Error alert -->
@elseif(session('err'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{session('err')}}.
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

    <div style="background-color: #fff; ">
        <div class="row" style="padding: 50px;">

        <div class="col-lg-3 shadow1" >
            <h1 class="">My Profile</h1>
            <div class="list-group">
            
                <div class="input-group">
                    <span class="input-group-addon" id="bas ic-addon1"><i class="fa fa-user fa-2x"></i></span>
                    <a href="#" class="list-group-item active" id="userFields">Change Profile</a>
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basnic-addon1"><i class="fa fa-lock fa-2x"></i></span>
                    <a href="#" class="list-group-item" id="userPassword">Change Password</a>
                </div>
            </div>
        </div>

        <div class="col-lg-8 shadow1" style="margin-left: 1px">

            <div class=" jumbotron jumbotron-fluid" style="background-color: #fff;">
                <div class="card">
                        <form method="POST" action="{{ url('/updateProfile',array($user->id)) }}">
                            @csrf

                            <div class="fields">
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="fname" 
                                        value=<?php echo  $user->fname; ?>>
                                        <div class="custom-control-input  @error('fname') is-invalid @enderror col-md-6" value="{{ old('fname') }}"></div>

                                        @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">

                                    <div class="col-md-6 margin-bottom">
                                        <input id="mname" type="text" class="form-control" name="mname" 
                                        value=<?php echo  $user->mname; ?> >
                                        <div class="custom-control-input  @error('mname') is-invalid @enderror col-md-6" value="{{ old('mname') }}"></div>

                                        @error('mname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                            <input id="lname" type="text" class="form-control" name="lname"
                                            value="<?php echo  $user->lname; ?>">
                                            <div class="custom-control-input  @error('lname') is-invalid @enderror col-md-6" value="{{ old('lname') }}"></div>

                                            @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control" name="email"
                                        value=<?php echo  $user->email; ?>>
                                        <div class="custom-control-input  @error('email') is-invalid @enderror col-md-6" value="{{ old('email') }}"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row margin-bottom">

                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                value=<?php echo  $user->phone; ?>>
                                                <div class="custom-control-input  @error('phone') is-invalid @enderror col-md-6" value="{{ old('phone') }}"></div>
                                        
                                        @error('phone')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror 
                                    </div>
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input name="username" type="text" class="form-control @error('username') is-invalid @enderror" 
                                        value=<?php echo  $user->username; ?> >
                                        
                                        @error('username')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>    
                            <div class="form-group row pass" style='display:none;'>

                            <div class="col-md-12 col-sm-6 mb-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password">

                                            @error('current_password')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>  
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                            @error('password')
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                            <input id="password-confirm" class="form-control" name="password_confirmation" type="password" ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 col-md-2 addUser">
                                    <button >
                                        <a type="submit" class="btn btn-primary">{{ __('Update') }}</a>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                        <a href="/home" class="btn btn-success float-right">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>

        </div>
        <!-- /.col-lg-9 -->

        </div>
    </div>

  </div>
@endsection