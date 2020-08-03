@extends('constants.headerAndSide')

    @section('content')
    @if(session('info'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{session('info')}}.
    </div>
    @endif
        <div class="col-lg-6">
            <div class="addUser"><a href="#" class="btn btn-primary">update user</a></div>

            <div class="box box-default updt" style="display: non e;">
                <div class="col-xl-12 jumbotron">
                    <div class="card ">
                            <form method="POST" action='{{ url("/updateUser/$user->id") }}'>
                                @csrf
                                <h3 class="text-center">Update <strong><em><?php echo  $user->fname; ?> <?php echo  $user->lname; ?> </em></strong> details</h3>

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

                                    <div class="col-md-6">
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

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email"
                                        value=<?php echo  $user->email; ?>>
                                        <div class="custom-control-input  @error('email') is-invalid @enderror col-md-6" value="{{ old('email') }}"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                            <select name="zone" id="zone" class="form-control">
                                                <option value=<?php echo  $user->zone; ?>> {{ ($user->zone) }} </option>
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
                                <div class="row">

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
                                <div class="form-group row mb-3">

                                    <div class="col-md-6">
                                        <h5 class="info-text"> Select the role </h5>
                                            <select name="role" id="role" class="form-control">
                                                <option value=<?php echo  $user->role; ?>> {{ ($user->role) }} </option>
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
                                    <label class="info-text"> Select the Gender </label>
                                            <select name="gender" class="form-control">
                                                <option value=<?php echo  $user->gender; ?>>{{ ($user->gender) }}</option>
                                                <option value="M"> M </option>
                                                <option value="F"> F </option>
                                            </select>
                                            
                                            <div class="custom-control-input  @error('gender') is-invalid @enderror col-md-6"></div>
                                        @error('gender')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0 bt">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary col-md-12 ">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                    <div class="col-md-6 offset-md-4 bt">
                                        <a href="/users" class="btn btn-success pull-right col-md-12">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

@endsection        
