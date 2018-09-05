@extends('layouts.master')
@section('head')
  <link rel="stylesheet" href="{{asset('js/plugins/datatables/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="loading">Loading&#8230;</div>
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard | Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box" id="div-total-employees">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total</span>
                <span class="info-box-number" id="employee-total">{{$total}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" id="div-absent-employees">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Absent</span>
                <span class="info-box-number" id="employee-absent">{{$total-$present}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" id="div-present-employees">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Present</span>
                <span class="info-box-number" id="employee-present">{{$present}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" id="div-late-employees">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Late</span>
                <span class="info-box-number" id="employee-late">{{$late}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div id="div-total-employees-container" class="no-display">
          @include('pages.dashboard.employees.total-employees-table')
        </div>
        <div id="div-absent-employees-container" class="no-display">
          @include('pages.dashboard.employees.absent-employees-table')
        </div>
        <div id="div-present-employees-container" class="no-display">
          @include('pages.dashboard.employees.present-employees-table')
        </div>
        <div id="div-late-employees-container" class="no-display">
          @include('pages.dashboard.employees.late-employees-table')
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Employee Present: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>

                    <div class="progress-group">
                      Add Products to Cart
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Complete Purchase
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Visit Premium Page</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Send Inquiries
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 17%</span>
                      <h5 class="description-header">$35,210.43</h5>
                      <span class="description-text">TOTAL REVENUE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fa fa-caret-left"></i> 0%</span>
                      <h5 class="description-header">$10,390.90</h5>
                      <span class="description-text">TOTAL COST</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fa fa-caret-up"></i> 20%</span>
                      <h5 class="description-header">$24,813.53</h5>
                      <span class="description-text">TOTAL PROFIT</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger"><i class="fa fa-caret-down"></i> 18%</span>
                      <h5 class="description-header">1200</h5>
                      <span class="description-text">GOAL COMPLETIONS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('footer')
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
  $(document).ready(function(){
    $('.loading').hide();
    $.ajax({
      'url': "/getTotalEmployees/",
      'method': "GET",
      'contentType': 'application/json'
    }).done( function(data) {
      console.log(data);
      $('#total-employees-table').dataTable({
        "aaData": data,
        "columns": [
            { "data": "name" },
            { "data": "branch.name" },
            { "data": "department.name" },
            { "data": "designation.name" },
            { "data": "punch_records.punch_1","defaultContent":"<i style='color:red'>No Data</i>" }
        ]
      });
    });
    $.ajax({
      'url': "/getPresentEmployees/",
      'method': "GET",
      'contentType': 'application/json'
    }).done( function(data) {
      console.log(data);
      $('#present-employees-table').dataTable({
        "aaData": data,
        "columns": [
            { "data": "employee.name" },
            { "data": "employee.branch.name" },
            { "data": "employee.department.name" },
            { "data": "employee.designation.name" },
            { "data": "punch_1" }
        ]
      });
    });
    $.ajax({
      'url': "/getAbsentEmployees/",
      'method': "GET",
      'contentType': 'application/json'
    }).done( function(data) {
      console.log(data);
      $('#absent-employees-table').dataTable({
        "aaData": data,
        
        "columns": [
            { "data": "name" },
            { "data": "branch.name" },
            { "data": "department.name" },
            { "data": "designation.name" },
            { "data": "applied_leaves[0].leave_from","defaultContent":"<i style='color:red'>Not Applied</i>"},
            { "data": "applied_leaves[0].leave_to","defaultContent":"<i style='color:red'>Not Applied</i>"}            
        ]
      });
    });
    $.ajax({
      'url': "/getLateEmployees/",
      'method': "GET",
      'contentType': 'application/json'
    }).done( function(data) {
      console.log("late employees: "+ data);
      $('#late-employees-table').dataTable({
        "aaData": data,
        "columns": [
            { "data": "employee.name" },
            { "data": "employee.branch.name" },
            { "data": "employee.department.name" },
            { "data": "employee.designation.name" },
            { "data": "late_in" }
        ]
      });
    });
    // SET AUTOMATIC PAGE RELOAD TIME TO 1000 MILISECONDS (1 SECOND * seconds we want).
    setInterval('refreshPageContents()', 1000*5);
  });
  function refreshPageContents() { 
    //location.reload(); 
    //console.log('Reloading page contents');
    $.get('/refreshDashboard/Business',function(data){
      //console.log(data);
      $('#employee-total').text(data.total).change();
      $('#employee-present').text(data.present).change();
      $('#employee-absent').text(data.total - data.present).change();
      $('#employee-late').text(data.late).change();
    });
  }

  $('#div-total-employees').click(function (e){
    $("#div-total-employees-container").addClass('display-block').removeClass('no-display');

    $('#div-present-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-absent-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-late-employees-container').addClass('no-display').removeClass('display-block');

    $('html, body').animate({
        scrollTop: $("#div-total-employees-container").offset().top
    }, 1000);
  });
  $('#div-absent-employees').click(function (e){
    $("#div-absent-employees-container").addClass('display-block').removeClass('no-display');

    $('#div-total-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-present-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-late-employees-container').addClass('no-display').removeClass('display-block');

    $('html, body').animate({
        scrollTop: $("#div-absent-employees-container").offset().top
    }, 1000);
  });
  $('#div-present-employees').click(function (e){
    $("#div-present-employees-container").addClass('display-block').removeClass('no-display');

    $('#div-total-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-absent-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-late-employees-container').addClass('no-display').removeClass('display-block');

    $('html, body').animate({
        scrollTop: $("#div-present-employees-container").offset().top
    }, 1000);
  });
  $('#div-late-employees').click(function (e){
    $("#div-late-employees-container").addClass('display-block').removeClass('no-display');

    $('#div-total-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-absent-employees-container').addClass('no-display').removeClass('display-block');
    $('#div-present-employees-container').addClass('no-display').removeClass('display-block');

    $('html, body').animate({
        scrollTop: $("#div-late-employees-container").offset().top
    }, 1000);
  });

</script>
@endsection