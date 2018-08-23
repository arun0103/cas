@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="{{asset('js/plugins/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('js/plugins/select2/select2.min.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection


@section('content')
    <div class="loading">Loading&#8230;</div>
    <div>
        <input type="hidden" id="inputCompanyId" disabled value="{{Session::get('company_id')}}">
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List Of Master Leaves
                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New</button>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="leaveMasterTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Leave ID</th>
                    <th>Name</th>
                    <th>Maximum Leave Allowed</th>
                    <th>Minimum Leave Allowed</th>
                    <th>Weekly Off Cover</th>
                    <th>Paid Holiday Cover</th>
                    <th>Club with leaves</th>
                    <th>Cannot Club with leaves</th>
                    <th>Balance Adjusted From</th>
                    <th>Treat Present</th>
                    <th>Treat Absent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="leaveMaster-list" name="leaveMaster-list">
                @foreach ($leaveMaster as $lt)
                <tr id="leaveMaster{{$lt->leave_id}}">
                    <td>{{$lt->leave_id}}</td>
                    <td>{{$lt->name}}</td>
                    <td>{{$lt->max_leave_allowed}}</td>
                    <td>{{$lt->min_leave_allowed}}</td>
                    <td>@if($lt->weekly_off_cover==1)
                        TRUE
                        @else
                        FALSE
                        @endif
                    </td>
                    <td>@if($lt->paid_holiday_cover==1)
                        TRUE
                        @else
                        FALSE
                        @endif
                    </td>
                    <td>{{$lt->club_with_leaves}}</td>
                    <td>{{$lt->cant_club_with_leaves}}</td>
                    <td>{{$lt->balance_adjusted_from}}</td>
                    <td>@if($lt->treat_present==1)
                        TRUE
                        @else
                        FALSE
                        @endif
                        </td>
                    <td>@if($lt->treat_absent==1)
                        TRUE
                        @else
                        FALSE
                        @endif</td>
                    <td>
                        <button class="btn btn-warning open_modal" value="{{$lt->leave_id}}"><i class="fa fa-edit"> </i> Edit</button>
                        <button class="btn btn-danger delete-leaveMaster" value="{{$lt->leave_id}}"><i class="fa fa-trash"> </i> Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Leave ID</th>
                    <th>Name</th>
                    <th>Maximum Leave Allowed</th>
                    <th>Minimum Leave Allowed</th>
                    <th>Weekly Off Cover</th>
                    <th>Paid Holiday Cover</th>
                    <th>Club with leaves</th>
                    <th>Cannot Club with leaves</th>
                    <th>Balance Adjusted From</th>
                    <th>Treat Present</th>
                    <th>Treat Absent</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="modal fade" id="modal-add">
        <form id="form_addLeaveMaster" class="form-horizontal" method="post" action="/addLeaveMaster">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add Leave Master</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20" id="addNewLeaveMaster"> 
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputLeaveId" class="control-label">Leave ID</label>
                                            <input type="text" class="form-control" id="inputLeaveId" placeholder="Leave ID" name="leave_id">
                                            <span id="error_msg_id">Leave ID must be unique!</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="leave_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputMaxLeaveAllowed" class="control-label">Maximum Leave Allowed</label>
                                            <input type="number" class="form-control" id="inputMaxLeaveAllowed" placeholder="Max Leave Allowed (in days)" name="maxLeaveAllowed"> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputMinLeaveAllowed" class="control-label">Minimum Leave Allowed </label>
                                            <input type="number" class="form-control" id="inputMinLeaveAllowed" placeholder="Mininum Leave Allowed (in days)" name="minLeaveAllowed">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class=" control-label">Weekly Off Cover</label>
                                            <div class="col-sm-12">
                                                <label for="radio_weekly_off_cover_true">Yes
                                                    <input type="radio" id="radio_weekly_off_cover_true" name="weekly_off_cover" value="1" class="flat-red" checked>
                                                </label>
                                                <label for="radio_weekly_off_cover_false">No
                                                    <input type="radio" id="radio_weekly_off_cover_false" name="weekly_off_cover" value="0" class="flat-red">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Paid Holiday Cover</label>
                                            <div class="col-sm-12">
                                                <label for="radio_paid_holiday_cover_true">Yes
                                                    <input type="radio" id="radio_paid_holiday_cover_true" name="paid_holiday_cover" value="1" class="flat-red" checked>
                                                </label>
                                                <label for="radio_paid_holiday_cover_false">No
                                                    <input type="radio" id="radio_paid_holiday_cover_false" name="paid_holiday_cover" value="0" class="flat-red">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label>Can Club with</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select id="select_can_club" class="form-control select2 percent100" multiple="multiple" data-placeholder="Select Leave(s) that can be clubbed with" name="selectedClubWith[]">
                                                        <option></option>
                                                        @foreach($allLeaves as $leave)
                                                        <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label>Cannot Club with</label>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select id="select_cannot_club" class="form-control select2 " multiple="multiple" data-placeholder="Select Leave(s) that cannot be clubbed with" name="selectedCannotClubWith[]">
                                                        <option></option>
                                                        @foreach($allLeaves as $leave)
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
                                            <label class="control-label">Treat Present</label>
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
                                            <label class="control-label">Treat Absent</label>
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
<script>
    var state;
    var original_leave_master_id;
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2').select2();
        
        //Initialize Datatables
        $('#leaveMasterTable').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "scrollX": true
        });
        $('.loading').hide();
    });
    
    //Opening Add Modal
    $('#btn_add').click(function(){
        state="add";
            $('#error_msg_id').removeClass('error').addClass('no-error');
            $('#btn_confirm').val("add");
            $('#btn_confirm').text("Add");
            $('#modal-title').text('Add Leave Master');
            $('#form_addLeaveMaster').trigger("reset");
            $('#select_can_club').val("").trigger("change");
            $('#select_cannot_club').val("").trigger("change");
            $('#modal-add').modal('show');
        });
    //Opening Edit Modal
    $(document).on('click', '.open_modal', function(){
        state="update";
        $('#error_msg_id').removeClass('error').addClass('no-error');
        var leave_master_id = $(this).val();
        $.get('/getLeaveMasterById/' + leave_master_id, function (data) {
            //success data
            original_leave_master_id = leave_master_id;
            console.log(data);
            $('#modal-add').modal('show');
            $('#inputLeaveId').val(data.leave_id);
            $('#inputName').val(data.name);
            $('#inputMaxLeaveAllowed').val(data.max_leave_allowed);
            $('#inputMinLeaveAllowed').val(data.min_leave_allowed);
            $('#inputBalanceAdjustedFrom').val(data.balance_adjusted_from);
            
            if(data.weekly_off_cover==0)
                $('#radio_weekly_off_cover_false').prop("checked", true);
            else
                $('#radio_weekly_off_cover_true').prop("checked", true);
            if(data.paid_holiday_cover==0)
                $('#radio_paid_holiday_cover_false').prop("checked", true);
            else
                $('#radio_paid_holiday_cover_true').prop("checked", true);
                
            var selected_can_club_with='',selected_cannot_club_with='';
            if(data.club_with_leaves!=null)
                selected_can_club_with = data.club_with_leaves.split(',');
            $('#select_can_club').val(selected_can_club_with).trigger("change");
            if(data.cant_club_with_leaves!=null)
                selected_cannot_club_with = data.cant_club_with_leaves.split(',');
            $('#select_cannot_club').val(selected_cannot_club_with).trigger("change");
            
            if(data.treat_present==0)
                $('#radio_treat_present_false').prop("checked", true);
            else
                $('#radio_treat_present_cover_true').prop("checked", true);
            if(data.treat_absent==0)
                $('#radio_treat_absent_false').prop("checked", true);
            else
                $('#radio_treat_absent_cover_true').prop("checked", true);
            
            $('#btn_confirm').val("update");
            $('#btn_confirm').text("Update");
            $('#modal-title').text('Edit Leave Master');
            
        }) 
    });

    //delete department and remove it from list
    $(document).on('click','.delete-leaveMaster',function(){
        if(confirm('You are about to delete a department. Are you sure?')){
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: '/deleteLeaveMaster/' + id,
                success: function (data) {
                    $("#leaveMaster" + id).remove();
                },
                error: function (data) {
                    console.error('Error:', data);
                }
            });
        }
        
    });
    
    
    var old_leave_master_id;
    //Detecting change on edit
    $(document).on('focusin', '#inputLeaveId', function(){
            //console.log("Saving value " + $(this).val());
            $(this).data('val', $(this).val());
        }).on('change','#inputLeaveId', function(){
            var current = $(this).val();
            if(state=="update"){
                if($('[id=leaveMaster'+original_leave_master_id+']').length>0 && original_leave_master_id !=current && $('[id=leaveMaster'+current+']').length>0){
                    $('#error_msg_id').removeClass('no-error').addClass('error');
                }
                else{
                    $('#error_msg_id').removeClass('error').addClass('no-error');
                }
            }else if(state=="add"){
                if($('[id=leaveMaster'+current+']').length>0){
                    $('#error_msg_id').removeClass('no-error').addClass('error');
                }
                else{
                    $('#error_msg_id').removeClass('error').addClass('no-error');
                }
            }
        
    });
    
    //create new product / update existing product
    $("#btn_confirm").click(function (e) {
        var type = "POST"; //for creating new resource
        var leave_master_id = $('#inputLeaveId').val();
        var url = '/addLeaveMaster'; // by default add department
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault(); 
        var selected_can_club='';
        $.each($('#select_can_club').val(), function(index, value){
            selected_can_club +=value;
            if(index != $('#select_can_club').val().length -1)
                selected_can_club += ',';
        });
        var selected_cannot_club='';
        $.each($('#select_cannot_club').val(), function(index, value){
            selected_cannot_club +=value;
            if(index != $('#select_cannot_club').val().length -1)
                selected_cannot_club += ',';
        });

        var checked_weekly_off_cover, checked_paid_holiday_cover, checked_treat_present, checked_treat_absent;
        if($('#radio_weekly_off_cover_false').prop("checked")==true)
            checked_weekly_off_cover = 0;
        else   
            checked_weekly_off_cover = 1;
        if($('#radio_paid_holiday_cover_false').prop("checked")==true)
            checked_paid_holiday_cover = 0;
        else   
            checked_paid_holiday_cover = 1;
        if($('#radio_treat_present_false').prop("checked")==true)
            checked_treat_present = 0;
        else   
            checked_treat_present = 1;
        if($('#radio_treat_absent_false').prop("checked")==true)
            checked_treat_absent = 0;
        else   
            checked_treat_absent = 1;

        var formData = {
            leave_id                : $('#inputLeaveId').val(),
            name                    : $('#inputName').val(),
            company_id              : $('#inputCompanyId').val(),
            max_leave_allowed       : $('#inputMaxLeaveAllowed').val(),
            min_leave_allowed       : $('#inputMinLeaveAllowed').val(),
            club_with_leaves        : selected_can_club,
            cant_club_with_leaves   : selected_cannot_club,
            balance_adjusted_from   : $('#inputBalanceAdjustedFrom').val(),
            weekly_off_cover        : checked_weekly_off_cover,
            paid_holiday_cover      : checked_paid_holiday_cover,
            treat_present           : checked_treat_present,
            treat_absent            : checked_treat_absent,
            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn_confirm').val();
        if(state=="add"){
            type = "POST"; 
            url = '/addLeaveMaster';
        }else if (state == "update"){
            type = "PUT"; //for updating existing resource
            url = '/updateLeaveMaster/' + original_leave_master_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var isWeeklyOffCoverTrue, isPaidHolidaCoverTrue, isTreatPresentTrue, isTreatAbsentTrue;
                if(data.weekly_off_cover==1)
                    isWeeklyOffCoverTrue = 'TRUE';
                else
                    isWeeklyOffCoverTrue = 'FALSE';
                if(data.paid_holiday_cover==1)
                    isPaidHolidaCoverTrue = 'TRUE';
                else
                    isPaidHolidaCoverTrue = 'FALSE';
                if(data.treat_present==1)
                    isTreatPresentTrue = 'TRUE';
                else
                    isTreatPresentTrue = 'FALSE';
                if(data.treat_absent==1)
                    isTreatAbsentTrue = 'TRUE';
                else
                    isTreatAbsentTrue = 'FALSE';
                var newRow = '<tr id="leaveMaster' + data.leave_id + '"><td>' + data.leave_id + '</td><td>'
                        + data.name + '</td><td>'+data.max_leave_allowed+'</td>'
                        +'<td>'+data.min_leave_allowed+'</td>'
                        +'<td>'+isWeeklyOffCoverTrue+'</td>'
                        +'<td>'+isPaidHolidaCoverTrue+'</td>'
                        +'<td>'+data.club_with_leaves+'</td>'
                        +'<td>'+data.cant_club_with_leaves+'</td>'
                        +'<td>'+data.balance_adjusted_from+'</td>'
                        +'<td>'+isTreatPresentTrue+'</td>'
                        +'<td>'+isTreatAbsentTrue+'</td>';
                newRow += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.leave_master_id + '"><i class="fa fa-edit"> </i> Edit</button>';
                newRow += ' <button class="btn btn-danger btn-delete delete-leaveMaster" value="' + data.leave_master_id + '"><i class="fa fa-trash"> </i> Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#leaveMaster-list').prepend(newRow);
                }else{ //if user updated an existing record
                    $("#leaveMaster" + original_leave_master_id).replaceWith( newRow );
                }
                $('#form_addLeaveMaster').trigger("reset");
                $('#modal-add').modal('hide');
            },
            error: function (data) {
                alert('Error: '+JSON.stringify(data));
                console.log('Error:', JSON.stringify(data));
            }
        });
    });

</script>
@endsection