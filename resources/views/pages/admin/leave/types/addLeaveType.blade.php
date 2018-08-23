@extends('layouts.master')
@section('head')
<link rel="stylesheet" href="{{asset('js/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('js/plugins/datatables/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('status') }}
    </div>
@endif
<div class="row roundPadding20" id="addNewLeaveType"> 
    <div class="col-sm-12">
        <form class="form-horizontal" method="post" action="/addLeaveToBranch">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group" >
                        <label>Branch</label>
                        <select class="form-control select2" data-placeholder="Select Branch" name="selectedBranch">
                            @foreach($branches as $branch)
                            <option value="{{$branch->branch_id}}">{{$branch->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" >
                        <label>Leave</label>
                        <select class="form-control select2" data-placeholder="Select Leave" name="selectedLeave">
                            @foreach($leaves as $leave)
                            <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div> 
        </form>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List Of Employees</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="addedLeaveTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Leave Name</th>
                    <th>Branch</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($companyLeave as $cl)
                <tr>
                    <td>{{$cl->leave_id}}</td>
                    <td>{{$cl->branch_id}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Leave Name</th>
                    <th>Branch</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

@endsection

@section('footer')
<script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>
<script>
$(document).ready(function() {
    
    //Initialize Select2 Elements
    $('.select2').select2();

})
</script>
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
  $(function () {

    $('#addedLeaveTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
@endsection