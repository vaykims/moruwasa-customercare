@extends('constants.headerAndSide')

@section('content')

    <!-- Main content -->
<?php $role = Auth::user()->role ?>

@if($role != 'agent')
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Total Complaints in each Month</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="dataChart" style="height: 46px; width: 116px;" height="46" width="116"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Complaints Statuses in <?php echo date("M/Y"); ?> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="statusChart" style="height: 300px; padding: 0px; position: relative;"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total monthly complaints based on zones</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="complaintLocation" style="height: 46px; width: 116px;" height="46" width="116"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <?php 
              $role = Auth::user()->role; 
              $manager_zone = Auth::user()->zone; 
              $date = date_create('2000-01-01');
                
          ?>
          @if($role == 'manager')
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Zone complaints details in <?php echo date("M/Y"); ?> </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <div class="box-body table-responsive">
                  <table id="" class="table table-bordered table-hover display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Complaints in {{($manager_zone)}}</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <th class="text-muted">Total</th>
                          <td>{{ ($total_complaints) }}</td>
                      </tr>
                      <tr>
                          <th class="text-muted">New <i class="fa fa-exclamation-circle text-danger"></i></th>
                          <td>{{ ($new_complaints) }}</td>
                      </tr>
                      <tr>
                          <th class="text-muted">In progress <i class="fa fa-spinner text-primary"></i></th>
                          <td>{{ ($progress_complaints) }}</td>
                      </tr>
                      <tr>
                          <th class="text-muted">Completed <i class="fa fa-check-circle text-success"></i></th>
                          <td>{{ ($completed_complaints) }}</td>
                      </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Complaints in {{($manager_zone)}}</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          @endif
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
@endif

<!-- view customer according to the agent zone -->
<?php  $zone = Auth::user()->zone ?> 
<?php  $role = Auth::user()->role ?> 
      <section class="content">
      <div class="row">
        <div class="col-xl-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Total Customers</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-hover display nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer Zone</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Customer category</th>
                    <th>Customer Meter</th>
                    <th>Meter Type</th>
                </tr>
                </thead>
                <tbody>
                @if(count($resp ?? '') > 0)   
                    @foreach($resp ?? ''->all() as $resp) 
                      <?php
                        $street = $resp->street ;
                        
                      ?>
                      @if(strtolower($resp->street) == strtolower($zone) and $role=="manager" )
                      <tr>
                          <td>{{ ($resp->name) }}</td>
                          <td>{{ ($resp->street) }}</td>
                          <td>{{ ($resp->gender) }}</td>
                          <td>{{ ($resp->phone) }}</td>
                          <td>{{ ($resp->category) }}</td>
                          <td>{{ ($resp->meter_no) }}</td>
                          <td>{{ ($resp->type) }}</td> 
                      </tr>
                      @elseif($role != 'manager')
                        <tr>
                          <td>{{ ($resp->name) }}</td>
                          <td>{{ ($resp->street) }}</td>
                          <td>{{ ($resp->gender) }}</td>
                          <td>{{ ($resp->phone) }}</td>
                          <td>{{ ($resp->category) }}</td>
                          <td>{{ ($resp->meter_no) }}</td>
                          <td>{{ ($resp->type) }}</td>
                        </tr> 
                      @endif  
                    @endforeach
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer Zone</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Customer category</th>
                    <th>Customer Meter</th>
                    <th>Meter Type</th>
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
