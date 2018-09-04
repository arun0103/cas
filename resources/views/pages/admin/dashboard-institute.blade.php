@extends('layouts.master')
@section('head')
  <link rel="stylesheet" href="{{asset('js/plugins/datatables/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="loading">Loading&#8230;</div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard | Admin</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <h4 style="margin:0 auto; text-align:center">Employees<h4>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box" id="div-total-employees">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total</span>
                <span class="info-box-number" id="employee-total">{{$employeeDetails['total']}}</span>
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
                <span class="info-box-number" id="employee-absent">{{$employeeDetails['total']-$employeeDetails['present']}}</span>
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
                <span class="info-box-number" id="employee-present">{{$employeeDetails['present']}}</span>
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
                <span class="info-box-number" id="employee-late">{{$employeeDetails['late']}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <hr>
        <h4 style="margin:0 auto; text-align:center">Students<h4>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box" id="div-total-students">
              <span class="info-box-icon bg-info elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total</span>
                <span class="info-box-number" id="student-total">{{$studentDetails['total']}}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" id="div-absent-students">
              <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Absent</span>
                <span class="info-box-number" id="student-absent">{{$studentDetails['total']-$studentDetails['present']}}</span>
              </div>
            </div>

          </div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" id="div-present-students">
              <span class="info-box-icon bg-success elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Present</span>
                <span class="info-box-number" id="student-present">{{$studentDetails['present']}}</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3" id="div-late-students">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Late</span>
                <span class="info-box-number" id="student-late">{{$studentDetails['late']}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="detail-table-employees" style="display:none">
      <h4 id="heading-employee-table">Total Employees Table</h4>
      <table id="employee-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
            
        </tbody>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Branch</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Status</th>
          </tr>
        </tfoot>
      </table>
    </section>
    <section id="detail-table-students" style="display:none">
      <h4 id="heading-student-table">Total Students Table</h4>
      <table id="students-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Guardian Name</th>
            <th>Contact #1</th>
            <th>Contact #2</th>
          </tr>
        </thead>
        <tbody id="table_row">
        </tbody>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Grade</th>
            <th>Section</th>
            <th>Guardian Name</th>
            <th>Contact #1</th>
            <th>Contact #2</th>
          </tr>
        </tfoot>
      </table>
    </section>
@endsection

@section('footer')
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
  
  
  $(document).ready(function(){
    $('.loading').hide();
   // $('.table').DataTable();
    
    // SET AUTOMATIC PAGE RELOAD TIME TO 1000 MILISECONDS (1 SECOND * seconds we want).
    setInterval('refreshPageContents()', 1000*60);
  });
  function refreshPageContents() { 
    //location.reload(); 
    //console.log('Reloading page contents');
    $.get('/refreshDashboard/Institute',function(data){
      //console.log(data);
      $('#employee-total').text(data.employee['total']).change();
      $('#employee-present').text(data.employee['present']).change();
      $('#employee-absent').text(data.employee['total'] - data.employee['present']).change();
      $('#employee-late').text(data.employee['late']).change();

      $('#student-total').text(data.student['total']).change();
      $('#student-present').text(data.student['present']).change();
      $('#student-absent').text(data.student['total'] - data.student['present']).change();
      $('#student-late').text(data.student['late']).change();


    });
  }

  $('#div-total-employees').click(function (e){
    
    $('#detail-table-employees').css('display','block');
    $('#detail-table-students').css('display','none');
    $('html, body').animate({
        scrollTop: $("#detail-table-employees").offset().top
    }, 1000);
  });

  $('#div-total-students').on('click',function(){
    $('#detail-table-employees').css('display','none');
    $.ajax({
        'url': "/getTotalStudents/",
        'method': "GET",
        'contentType': 'application/json'
    }).done( function(data) {
      console.log(data);
      
      $('#students-table').dataTable( {
          "aaData": data,
          "columns": [
              { "data": "name" },
              { "data": "grade.name" },
              { "data": "section.name" },
              { "data": "guardian_name" },
              { "data": "contact_1_number" },
              { "data": "contact_2_number" },
          ]
      });
      $('#detail-table-students').css('display','block');
      $('html, body').animate({
          scrollTop: $("#detail-table-students").offset().top
      }, 1000);
    });
    // $.get('/getTotalStudents/',function(data){
    //   console.log(data);
    //   $("#students-table").find('tbody').empty();
    //   console.log(t.data().count() + ' '+ data.length);
    //   if(t.data().count()/6 != data.length){
    //     console.log('Entered after length check');
    //     $.each(data, function(index,value){
    //       t.row.add( [
    //         value.name,
    //         value.grade['name'],
    //         value.section['name'],
    //         value.guardian_name,
    //         value.contact_1_number + ',' +value.contact_2_number,
    //         ' '
    //       ]).draw();
    //     });
    //   }  
    // });
   
    
  });
  $('#div-absent-students').on('click',function(){
    $('#detail-table-employees').css('display','none');
    $.ajax({
        'url': "/getAbsentStudents/",
        'method': "GET",
        'contentType': 'application/json'
    }).done( function(data) {
      console.log(data);
      
      $('#students-table').dataTable( {
          "aaData": data,
          "columns": [
              { "data": "name" },
              { "data": "grade.name" },
              { "data": "section.name" },
              { "data": "guardian_name" },
              { "data": "contact_1_number" },
              { "data": "contact_2_number" },
          ]
      });
      $('#detail-table-students').css('display','block');
      $('html, body').animate({
          scrollTop: $("#detail-table-students").offset().top
      }, 1000);
    });
  });

</script>
@endsection