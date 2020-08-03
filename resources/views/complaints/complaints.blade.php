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

        <div class="col-lg-4">
            <div class="addUser"><a href="#" class="btn btn-primary">add complaint</a></div>

            <div class="box box-default" >
                <div class="col-xl-12 jumbotron">
                    <div class="card ">
                            <form method="POST" action="{{ url('/save_complaint') }}">
                                @csrf


                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" 
                                        required autocomplete="name" autofocus placeholder="Customer name">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">

                                    <div class="col-md-6">
                                        <label>Meter Number</label>
                                        <input id="meter_no" type="text" class="form-control @error('meter_no') is-invalid @enderror" name="meter_no" 
                                        value="{{ old('meter_no') }}" autocomplete="meter_no" placeholder="Account Number" >

                                        @error('meter_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

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
                                </div>

                                <div class="form-group row mb-3">

                                    <div class="col-md-6">
                                        <h5 class="info-text"> Select the zone </h5>
                                            <select name="zone" id="zone" class="form-control">
                                                <option value=""> select.. </option>
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
                                    <div class="col-md-6">
                                        <h5 class="info-text"> Select the Complaint Type </h5>
                                            <select name="complaint_type" class="form-control">
                                                <option value="">select..</option>
                                                <option value="high bill">High bills</option>
                                                <option value="no water">No water service</option>
                                                <option value="meter defaults">Meter defaults</option>
                                                <option value="leakage">Water leakage</option>
                                                <option value="">Others</option>
                                            </select>
                                            
                                            <div class="custom-control-input  @error('complaint_type') is-invalid @enderror col-md-6"></div>
                                        @error('complaint_type')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>    
                                <div class="form-group row mb-3">
                                    <div class="col-md-12">
                                        <input type="textarea" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" 
                                        autocomplete="description" autofocus placeholder="Problem Description">

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <h5 class="info-text"> Select the Reported via </h5>
                                            <select name="report_medium" class="form-control">
                                                <option value="">select..</option>
                                                <option value="phone">Phone call</option>
                                                <option value="direct">Direct</option>
                                                <option value="website">Website</option>
                                            </select>
                                            
                                            <div class="custom-control-input  @error('report_medium') is-invalid @enderror col-md-6"></div>
                                        @error('report_medium')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="info-text"> Select the Priority </h5>
                                            <select name="complaint_priority" class="form-control">
                                                <option value="">select..</option>
                                                <option value="high">High</option>
                                                <option value="medium">Medium</option>
                                                <option value="low">low</option>
                                            </select>
                                            
                                            <div class="custom-control-input  @error('complaint_priority') is-invalid @enderror col-md-6"></div>
                                        @error('complaint_priority')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Add') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

@endsection