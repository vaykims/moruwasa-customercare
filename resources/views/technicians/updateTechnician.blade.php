@extends('constants.headerAndSide')

    @section('content')
    @if(session('info'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{session('info')}}.
    </div>
    @endif
        <div class="col-lg-6 ">
            <div class="addUser"><a href="#" class="btn btn-primary">Update Technician</a></div>

            <div class="box box-default">
                <div class="col-xl-12 jumbotron">
                    <div class="card ">
                            <form method="POST" action='{{ url("/update_tech/$technician->id") }}'>
                                @csrf


                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="fname" 
                                        value=<?php echo  $technician->fname; ?>>
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
                                        value=<?php echo  $technician->mname; ?> >
                                        <div class="custom-control-input  @error('mname') is-invalid @enderror col-md-6" value="{{ old('mname') }}"></div>

                                        @error('mname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                            <input id="lname" type="text" class="form-control" name="lname"
                                            value="<?php echo  $technician->lname; ?>">
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
                                        value=<?php echo  $technician->email; ?>>
                                        <div class="custom-control-input  @error('email') is-invalid @enderror col-md-6" value="{{ old('email') }}"></div>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-6">
                                        <label>Phone*</label>
                                        <input name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror"
                                                value=<?php echo  $technician->phone; ?>>
                                                <div class="custom-control-input  @error('phone') is-invalid @enderror col-md-6" value="{{ old('phone') }}"></div>
                                        
                                        @error('phone')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="info-text"> Select the Gender* </label>
                                            <select name="gender" class="form-control">
                                                <option value=<?php echo  $technician->gender; ?>>{{ ($technician->gender) }}</option>
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
                                <div class="form-group row mb-3">

                                    <div class="col-md-12">
                                        <h5 class="info-text"> Select the zone </h5>
                                            <select name="zone" id="zone" class="form-control">
                                                <option value=<?php echo  $technician->gender; ?>>{{ ($technician->zone) }}</option>
                                                <option value="mazimbu"> Mazimbu </option>
                                                <option value="sabasaba">Sabasaba</option>
                                                <option value="msanvu"> Msanvu</option>
                                                <option value="mindu"> Mindu</option>
                                                <option value="boma"> Boma</option>
                                                <option value="kihonda"> Kihonda</option>
                                            </select>
                                        <div class="custom-control-input  @error('zone') is-invalid @enderror col-md-6"></div>
                                        @error('zone')
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
                                        <a href="/view_tech" class="btn btn-success pull-right col-md-12">
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
