@extends('layouts.master')
@section('head')
<link rel="stylesheet" href="{{asset('js/plugins/select2/select2.min.css')}}">
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('status') }}
    </div>
@endif
<div class="modal fade" id="modal-add">
    <form id="form_addLeaveMaster" class="form-horizontal" method="post" action="/addLeaveMaster">
        {{ csrf_field() }}
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Add Leave Master</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row roundPadding20" id="addNewLeaveMaster"> 
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputLeaveId" class="col-sm-4 control-label">Leave ID</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputLeaveId" placeholder="Leave ID" name="leave_id">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-4 control-label">Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="leave_name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputMaxLeaveAllowed" class="col-sm-2 control-label">Maximum Leave Allowed</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputMaxLeaveAllowed" placeholder="Max Leave Allowed (in days)" name="maxLeaveAllowed">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputMinLeaveAllowed" class="col-sm-2 control-label">Minimum Leave Allowed </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputMinLeaveAllowed" placeholder="Mininum Leave Allowed (in days)" name="minLeaveAllowed">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Weekly Off Cover</label>
                                <div class="col-sm-8">
                                    <label for="radio_weekly_off_cover_true">Yes
                                        <input type="radio" id="radio_weekly_off_cover_true" name="weekly_off_cover" value="1" class="flat-red" checked>
                                    </label>
                                    <label for="radio_weekly_off_cover_false">No
                                        <input type="radio" id="radio_weekly_off_cover_false" name="weekly_off_cover" value="0" class="flat-red">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Paid Holiday Cover</label>
                                <div class="col-sm-8">
                                    <label for="radio_paid_holiday_cover_true">Yes
                                        <input type="radio" id="radio_paid_holiday_cover_true" name="paid_holiday_cover" value="1" class="flat-red" checked>
                                    </label>
                                    <label for="radio_paid_holiday_cover_false">No
                                        <input type="radio" id="radio_paid_holiday_cover_false" name="paid_holiday_cover" value="0" class="flat-red">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label>Can Club with</label>
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select Leave(s) that can be clubbed with" name="selectedClubWith[]">
                                    @foreach($allLeaves as $leave)
                                    <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" >
                                <label>Cannot Club with</label>
                                <select class="form-control select2" multiple="multiple" data-placeholder="Select Leave(s) that cannot be clubbed with" name="selectedCannotClubWith[]">
                                    @foreach($allLeaves as $leave)
                                    <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputBalanceAdjustedFrom" class="col-sm-2 control-label">Balance Adjusted From</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputBalanceAdjustedFrom" placeholder="Balance Adjusted From" name="balanceAdjustedFrom">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Treat Present</label>
                                <div class="col-sm-8">
                                    <label for="radio_treat_present_true">Yes
                                        <input type="radio" id="radio_treat_present_true" name="treat_present" value="1" class="flat-red" checked>
                                    </label>
                                    <label for="radio_treat_present_false">No
                                        <input type="radio" id="radio_treat_present_false" name="treat_present" value="0" class="flat-red">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Treat Absent</label>
                                <div class="col-sm-8">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn_confirm" value="Add">Add</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->"
    </form>
</div>
<div class="row roundPadding20" id="addNewLeaveMaster"> 
    <div class="col-sm-12">
        <form class="form-horizontal" method="post" action="/addLeaveMaster">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputLeaveId" class="col-sm-4 control-label">Leave ID</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputLeaveId" placeholder="Leave ID" name="leave_id">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="leave_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputMaxLeaveAllowed" class="col-sm-2 control-label">Maximum Leave Allowed</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputMaxLeaveAllowed" placeholder="Max Leave Allowed (in days)" name="maxLeaveAllowed">
                </div>
            </div>
            <div class="form-group">
                <label for="inputMinLeaveAllowed" class="col-sm-2 control-label">Minimum Leave Allowed </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputMinLeaveAllowed" placeholder="Mininum Leave Allowed (in days)" name="minLeaveAllowed">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Weekly Off Cover</label>
                <div class="col-sm-8">
                    <label for="radio_weekly_off_cover_true">Yes
                        <input type="radio" id="radio_weekly_off_cover_true" name="weekly_off_cover" value="1" class="flat-red" checked>
                    </label>
                    <label for="radio_weekly_off_cover_false">No
                        <input type="radio" id="radio_weekly_off_cover_false" name="weekly_off_cover" value="0" class="flat-red">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Paid Holiday Cover</label>
                <div class="col-sm-8">
                    <label for="radio_paid_holiday_cover_true">Yes
                        <input type="radio" id="radio_paid_holiday_cover_true" name="paid_holiday_cover" value="1" class="flat-red" checked>
                    </label>
                    <label for="radio_paid_holiday_cover_false">No
                        <input type="radio" id="radio_paid_holiday_cover_false" name="paid_holiday_cover" value="0" class="flat-red">
                    </label>
                </div>
            </div>
            <div class="form-group" >
                <label>Can Club with</label>
                <select class="form-control select2" multiple="multiple" data-placeholder="Select Leave(s) that can be clubbed with" name="selectedClubWith[]">
                    @foreach($allLeaves as $leave)
                    <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" >
                <label>Cannot Club with</label>
                <select class="form-control select2" multiple="multiple" data-placeholder="Select Leave(s) that cannot be clubbed with" name="selectedCannotClubWith[]">
                    @foreach($allLeaves as $leave)
                    <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                    @endforeach
                    
                </select>
            </div>

            <div class="form-group">
                <label for="inputBalanceAdjustedFrom" class="col-sm-2 control-label">Balance Adjusted From</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputBalanceAdjustedFrom" placeholder="Balance Adjusted From" name="balanceAdjustedFrom">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Treat Present</label>
                <div class="col-sm-8">
                    <label for="radio_treat_present_true">Yes
                        <input type="radio" id="radio_treat_present_true" name="treat_present" value="1" class="flat-red" checked>
                    </label>
                    <label for="radio_treat_present_false">No
                        <input type="radio" id="radio_treat_present_false" name="treat_present" value="0" class="flat-red">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Treat Absent</label>
                <div class="col-sm-8">
                    <label for="radio_treat_absent_true">Yes
                        <input type="radio" id="radio_treat_absent_true" name="treat_absent" value="1" class="flat-red" checked>
                    </label>
                    <label for="radio_treat_absent_false">No
                        <input type="radio" id="radio_treat_absent_false" name="treat_absent" value="0" class="flat-red">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div> 
        </form>
    </div>
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
@endsection