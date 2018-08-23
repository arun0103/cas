@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="{{asset('js/plugins/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('js/plugins/timepicker/bootstrap-timepicker.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <div class="loading">Loading&#8230;</div>
    <div>
        <input type="hidden" id="inputCompanyId" disabled value="{{Session::get('company_id')}}">
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List Of Shifts
                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New</button>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="shiftTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Shift ID</th>
                    <th>Shift Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Early Grace (in min)</th>
                    <th>Late Grace (in min)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="shifts-list" name="shifts-list">
                @foreach($shifts as $shift)
                    <tr id="shift{{$shift->shift_id}}">
                        <td>{{$shift->shift_id}}</td>
                        <td>{{$shift->name}}</td>
                        <td>{{$shift->start_time}}</td>
                        <td>{{$shift->end_time}}</td>
                        <td>{{$shift->grace_early}}</td>
                        <td>{{$shift->grace_late}}</td>
                        <td>
                            <button class="btn btn-warning open_modal" value="{{$shift->shift_id}}"><i class="fa fa-edit"> </i> Edit</button>
                            <button class="btn btn-danger delete-row" value="{{$shift->shift_id}}"><i class="fa fa-trash"> </i> Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Shift ID</th>
                    <th>Shift Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Early Grace (in min)</th>
                    <th>Late Grace (in min)</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="modal fade" id="modal-add">
        <form id="form_addShift" class="form-horizontal" method="post" action="/addShift">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" style="width:90% !important;height:90% !important; padding:0;margin:0 auto">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add Shift</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputShiftId" class="control-label">Shift ID</label>
                                    <input type="text" class="form-control" id="inputShiftId" placeholder="Shift ID" name="shift_id">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="shift_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label for="timePicker_start" class="control-label">Start Time</label>
                                        <div class="input-group-addon left-addon"> 
                                            <input type="text" class="form-control timepicker pull-right" id="timePicker_start" name="start_time">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label for="timePicker_end" class="control-label">End Time</label>
                                        <div class="input-group-addon left-addon">
                                            <input type="text" class="form-control timepicker pull-right" id="timePicker_end" name="end_time">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputGraceEarly" class="control-label">Early Grace</label>
                                    <input type="number" class="form-control" id="inputGraceEarly" placeholder="Early Grace (in minutes)" name="early_grace">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputGraceLate" class="control-label">Late Grace</label>
                                    <input type="number" class="form-control" id="inputGraceLate" placeholder="Late Grace (in minutes)" name="late_grace">
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
    <!-- /.modal -->

@endsection

@section('footer')
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#shiftTable').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
        });
        $('#timePicker_start').timepicker({
            showInputs: false
        });
        $('#timePicker_end').timepicker({
            showInputs: false
        });
        $('.loading').hide();
    });

    var original_shift_id;
    var state;
    var company_id;
    //Opening Add Modal
    $('#btn_add').click(function(){
        state="add";

        $('#error_msg_id').removeClass('error').addClass('no-error');
        $('#form_addshift').trigger("reset");
        $('#btn_confirm').val("add");
        $('#btn_confirm').text("Add");
        $('#modal-title').text('Add Shift');
        $('#modal-add').modal('show');    
    });
    //Opening Edit Modal
    $(document).on('click', '.open_modal', function(){
        state="update";
        $('#error_msg_id').removeClass('error').addClass('no-error');
        var shift_id = $(this).val();
        $.get('/getShiftById/' + shift_id, function (data) {
            //success data
            original_shift_id = shift_id;
            console.log(data);
            $('#inputShiftId').val(data.shift_id);
            $('#inputName').val(data.name);
            $('#timePicker_start').val(data.start_time);
            $('#timePicker_end').val(data.end_time);
            $('#inputGraceEarly').val(data.grace_early);
            $('#inputGraceLate').val(data.grace_late);

            $('#btn_confirm').val("update");
            $('#btn_confirm').text("Update");
            $('#modal-title').text('Edit Shift');
            $('#modal-add').modal('show');
        }) 
    });

    //delete shift and remove it from list
    $(document).on('click','.delete-row',function(){
        if(confirm('You are about to delete a shift. Are you sure?')){
            var shift_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: '/deleteShift/' + shift_id,
                success: function (data) {
                    $("#shift" + shift_id).remove();
                },
                error: function (data) {
                    console.error('Error:', data.responseJSON);
                }
            });
        }
        
    });
    
    
    var old_shift_id;
    //Detecting change on edit
    $(document).on('focusin', '#inputShiftId', function(){
        $(this).data('val', $(this).val());
    }).on('change','#inputShiftId', function(){
        var current = $(this).val();
        if(state=="update"){
            if($('[id=shift'+original_shift_id+']').length>0 && original_shift_id !=current && $('[id=shift'+current+']').length>0){
                $('#error_msg_id').removeClass('no-error').addClass('error');
            }else{
                $('#error_msg_id').removeClass('error').addClass('no-error');
            }
        }
        else if(state=="add"){
            if($('[id=shift'+current+']').length>0){
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
        var shift_id = $('#inputShiftId').val();
        var url = '/addShift'; // by default add shift
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            company_id          : $('#inputCompanyId').val(),
            shift_id            : $('#inputShiftId').val(),
            name                : $('#inputName').val(),
            start_time          : $('#timePicker_start').val(),
            end_time            : $('#timePicker_end').val(),
            grace_early         : $('#inputGraceEarly').val(),
            grace_late          : $('#inputGraceLate').val(),
            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn_confirm').val();
        if(state=="add"){
            type = "POST"; 
            url = '/addShift';
        }else if (state == "update"){
            type = "PUT"; //for updating existing resource
            url = '/updateShift/' + original_shift_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var shift = '<tr id="shift'+data.shift_id +'"><td>' + data.shift_id + '</td><td>'
                                                                    + data.name + '</td><td>' 
                                                                    + data.start_time + '</td><td>' 
                                                                    + data.end_time + '</td><td>' 
                                                                    + data.grace_early + '</td><td>' 
                                                                    + data.grace_late + '</td>' ;
                shift += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.shift_id + '"><i class="fa fa-edit"> </i> Edit</button>';
                shift += ' <button class="btn btn-danger btn-delete delete-row" value="' + data.shift_id + '"><i class="fa fa-trash"> </i> Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#shifts-list').append(shift);
                }else{ //if user updated an existing record
                    $("#shift" + original_shift_id).replaceWith( shift );
                }
                $('#form_addShift').trigger("reset");
                $('#modal-add').modal('hide');
            },
            error: function (data) {
                alert('Error: '+JSON.stringify(data['responseJSON']));
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection