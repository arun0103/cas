@extends('layouts.master')

@section('head')
    <link rel="stylesheet" href="{{asset('js/plugins/datatables/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/select2/select2.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="loading">Loading&#8230;</div>
    <input type="hidden" id="inputCompanyId" disabled value="{{Session::get('company_id')}}">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List Of Employee Leaves Quota
                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New</button>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="leaveMasterTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Employee</th>
                        <th>Leave</th>
                        <th>Alloted</th>
                        <th>Used</th>
                    </tr>
                </thead>
                <tbody id="leaveQuota-list" name="leaveQuota-list">
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>Branch</th>
                        <th>Employee</th>
                        <th>Leave</th>
                        <th>Alloted</th>
                        <th>Used</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="modal fade" id="modal-add">
        <form id="form_addLeaveQuota" class="form-horizontal" method="post" action="/addLeaveQuota">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add Leave Quota</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20" id="addNewLeaveMaster"> 
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label for="select_branch">Branch</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select id="select_branch" class="form-control select2 percent100" data-placeholder="Select Branch" name="selectedBranch">
                                                        @foreach($branches as $branch)
                                                        <option value="{{$branch->branch_id}}">{{$branch->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label for="select_employee">Employee</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select id="select_employee" class="form-control select2 " multiple="multiple" data-placeholder="Select Employees" name="selectedEmployees[]">
                                                        @foreach($employees as $employee)
                                                            <option value="{{$employee->leave_id}}">{{$employee->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label for="select_leave">Leave</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select id="select_leave" class="form-control select2 " multiple="multiple" data-placeholder="Select Leave" name="selectedLeaves[]">
                                                        @foreach($leaves as $leave)
                                                            <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>  
                                </div>

                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputBalanceAdjustedFrom" class="control-label">Balance Adjusted From</label>
                                            <input type="text" class="form-control" id="inputBalanceAdjustedFrom" placeholder="Balance Adjusted From" name="balanceAdjustedFrom">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">Treat Present <span class="required">*</span></label>
                                            <div class="col-sm-12">
                                                <label for="radio_treat_present_true">Yes
                                                    <input type="radio" id="radio_treat_present_true" name="treat_present" value="1" class="flat-red" checked>
                                                </label>
                                                <label for="radio_treat_present_false">No
                                                    <input type="radio" id="radio_treat_present_false" name="treat_present" value="0" class="flat-red">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">Treat Absent <span class="required">*</span></label>
                                            <div class="col-sm-12">
                                                <label for="radio_treat_absent_true">Yes
                                                    <input type="radio" id="radio_treat_absent_true" name="treat_absent" value="1" class="flat-red" checked>
                                                </label>
                                                <label for="radio_treat_absent_false">No
                                                    <input type="radio" id="radio_treat_absent_false" name="treat_absent" value="0" class="flat-red">
                                                </label> 
                                            </div>   
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn_confirm" value="Add">Add</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </form>
    </div>


@endsection

@section('footer')
    <script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>
@endsection