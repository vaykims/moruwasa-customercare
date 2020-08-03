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
<section class="content">
      <div class="row">
        <div class="col-xl-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">New complaints</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-hover display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Meter Number</th>
                    <th>Zone</th>
                    <th>Phone</th>
                    <th>Complaint Type</th>
                    <th>Reported Via</th>
                    <th>Complaint Priority</th>
                    <th>Complaint Description</th>
                    <th>Assign Technician</th>
                </tr>
                </thead>
                <tbody>
                @if(count($complaints ?? '') > 0)   
                    @foreach($complaints ?? ''->all() as $complaint) 
                <tr>
                    <td>{{ ($complaint->name) }}</td>
                    <td>{{ ($complaint->meter_no) }}</td>
                    <td>{{ ($complaint->zone) }}</td>
                    <td>{{ ($complaint->phone) }}</td>
                    <td>{{ ($complaint->complaint_type) }}</td>
                    <td>{{ ($complaint->report_medium) }}</td>
                    <td>{{ ($complaint->complaint_priority) }}</td>
                    @if($complaint->description !== null)
                        <td>{{ ($complaint->description) }}</td>
                    @else
                        <td>not assigned</td>
                    @endif
                    <td >
                      <a href='#' data-toggle="modal" data-target="#{{ ($complaint->id) }}" class="inline-flex float-left bg-maroon-active badge badge-danger">assign tech</a>
                    </td>
                    
                  <!-- Modal -->
                  <div class="modal fade" id="{{ ($complaint->id) }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><em>Assigning Technician</em></h4>
                            </div>
                            <form action='{{ url("assignTechnician/{$complaint->id}") }}' method="POST">
                              @csrf
                              <div class="modal-body">
                                  <div class="bg-light text-center">
                                    <div class="form-group col">
                                      <label for="message-text" class="control-label">Assign {{($complaint->complaint_type)}} complaint at {{($complaint->zone)}} to:</label>
                                      <div class="col-md-12">
                                        <select name="fname" class="form-control" required>
                                              <option value=""> choose.. </option>
                                          @if(count($technicians ?? '') > 0)   
                                            @foreach($technicians ?? ''->all() as $technician)
                                              <option value=<?php echo $technician->fname ?>> {{($technician->fname)}} {{($technician->lname)}} </option>
                                            @endforeach
                                        @endif
                                        </select>
                                      </div>
                                    </div>  
                                  </div>

                              </div>
                              <div class="modal-footer form-group row">
                                <div class="col-md-12">
                                  <div class="col-md-6">
                                    <div class="addUser"><a type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</a></div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="addUser"><button><a type="submit" class="btn btn-primary pull-right">Assign</a></button></div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>
                </tr>
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Customer Name</th>
                    <th>Meter Number</th>
                    <th>Zone</th>
                    <th>Phone</th>
                    <th>Complaint Type</th>
                    <th>Reported Via</th>
                    <th>Complaint Priority</th>
                    <th>Complaint Description</th>
                    <th>Assign Technician</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
      </div>
      <!-- /.row -->

      
    </section>
@endsection