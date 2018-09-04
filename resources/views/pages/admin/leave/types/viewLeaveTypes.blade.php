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
            <h3 class="box-title">List Of Leaves
                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New</button>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="leaveTable" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Leave Name</th>
                        <th>Branch</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="leaves-list" name="leaves-list">
                    @if(count($dataToDisplay)>0)
                        @foreach($dataToDisplay as $row)
                        <tr id="leave{{$row['leave_id']}}___{{$row['branch_id']}}">
                            <td>{{$row['leave_name']}}</td>
                            <td>{{$row['branch_name']}}</td>
                            <td>
                                <button class="btn btn-warning open_modal" value="{{$row['leave_id']}}___{{$row['branch_id']}}"><i class="fa fa-edit"> </i></button>
                                <button class="btn btn-danger delete-row" value="{{$row['leave_id']}}___{{$row['branch_id']}}"><i class="fa fa-trash"> </i></button>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>Leave Name</th>
                        <th>Branch</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="modal fade" id="modal-add">
        <form id="form_addLeaveType" class="form-horizontal" method="post" action="/addLeaveType">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add Leave Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20" id="addNewLeaveType"> 
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="select_branch_id">Branch <span class="required">*</span></label>
                                            <select id="select_branch_id" class="form-control select2" data-placeholder="Select Branch" name="selectedBranch">
                                                <option></option>    
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->branch_id}}">{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label for="select_leave_id">Leave <span class="required">*</span></label>
                                                <select id="select_leave_id" class="form-control select2" data-placeholder="Select Leave" name="selectedLeave">
                                                    <option></option>
                                                    @foreach($leaves as $leave)
                                                        <option value="{{$leave->leave_id}}">{{$leave->name}}</option>
                                                    @endforeach
                                            </select>
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
            <!-- /.modal-dialog -->"
        </form>
    </div>
@endsection

@section('footer')
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('js/plugins/select2/select2.full.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#leaveTable').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true
        });
        //Initialize Select2 Elements
        $('.select2').select2({
            width: ''
        });
        $('.loading').hide();
    });
    
    var state;
    var original_leave_id, orginal_branch_id;
    
    //Opening Add Modal
    $('#btn_add').click(function(){
        state="add";
        
            $('#error_msg_id').removeClass('error').addClass('no-error');

            $('#select_leave_id').val("none").trigger('change');
            $('#select_branch_id').val("none").trigger('change');
            $('#btn_confirm').val("add");
            $('#btn_confirm').text("Add");
            $('#modal-title').text('Add Leave Type');
            $('#form_addLeaveType').trigger("reset");
            $('#modal-add').modal('show');
        });
    //Opening Edit Modal
    $(document).on('click', '.open_modal', function(){
        state="update";
        $('#form_addLeaveType').trigger("reset");
        $('#error_msg_id').removeClass('error').addClass('no-error');
        var combined_id = $(this).val();
        var id = combined_id.split('___');
        var leave_type_id = id[0];
        var branch_id = id[1];

        //console.log(id);
        $.get('/getLeaveTypeById/' + leave_type_id+'/'+branch_id, function (data) {
            
            //success data
            original_leave_id = leave_type_id;
            original_branch_id = branch_id;
            //console.log(data);
            
            $('#select_leave_id').val(data.leave_id).trigger("change");
            $('#select_branch_id').val(data.branch_id).trigger("change");
            // $('#select_leave_id').text(data.leave_name).trigger("change");
            // $('#select_branch_id').text(data.branch_name).trigger("change");
            
            $('#btn_confirm').val("update");
            $('#btn_confirm').text("Update");
            $('#modal-title').text('Edit Leave Master');
            $('#modal-add').modal('show');
            
        }) 
    });

    //delete department and remove it from list
    $(document).on('click','.delete-row',function(){
        if(confirm('You are about to delete a Leave Type. Are you sure?')){
            var combined_id = $(this).val();
            var id = combined_id.split('___');
            var leave_type_id = id[0];
            var branch_id = id[1];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: '/deleteLeaveType/' + leave_type_id+'/'+branch_id,
                success: function (data) {
                    $("#leave" + combined_id).remove();
                },
                error: function (data) {
                    console.error('Error:', data);
                }
            });
        }
        
    });
    
    
    var old_leave_type_id;
    //Detecting change on edit
    $(document).on('focusin', '#inputLeaveId', function(){
            //console.log("Saving value " + $(this).val());
            $(this).data('val', $(this).val());
        }).on('change','#inputLeaveId', function(){
            var current = $(this).val();
            if(state=="update"){
                if($('[id=leaveMaster'+original_leave_id+']').length>0 && original_leave_id !=current && $('[id=leaveMaster'+current+']').length>0){
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
        if($('#select_branch_id').val()=="none" ){
            alert("Select Branch");
            e.preventDefault();
        }
        else if($('#select_leave_id').val()=="none"){
            alert('Select Leave');
            e.preventDefault();
        }
        else{
            var type = "POST"; //for creating new resource
            var leave_type_id = $('#select_leave_id').val();
            var url = '/addLeaveToBranch'; // by default add department
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault(); 
            var formData = {
                leave_id                : $('#select_leave_id').val(),
                company_id              : $('#inputCompanyId').val(),
                branch_id               : $('#select_branch_id').val(),
            }
            //used to determine the http verb to use [add=POST], [update=PUT]
            var state = $('#btn_confirm').val();
            if(state=="add"){
                type = "POST"; 
                url = '/addLeaveToBranch';
            }else if (state == "update"){
                type = "PUT"; //for updating existing resource
                url = '/updateLeaveType/' + original_leave_id+'/'+original_branch_id;
            }
            //console.log(formData);
            $.ajax({
                type: type,
                url: url,
                data: formData,
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    
                    var newRow = '<tr id="leave' + data.data.leave_id+'___'+data.data.branch_id + '"><td>' + data.names.leave_name + '</td><td>'
                                + data.names.branch_name + '</td>';
                        newRow += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.data.leave_id+'___'+data.data.branch_id + '"><i class="fa fa-edit"> </i></button>';
                        newRow += ' <button class="btn btn-danger btn-delete delete-row" value="' + data.data.leave_id+'___'+data.data.branch_id + '"><i class="fa fa-trash"> </i></button></td></tr>';
                        
                    if (state == "add"){ //if user added a new record
                        $('#leaves-list').prepend(newRow);
                    }else{ //if user updated an existing record
                        $('#leave' + original_leave_id+'___'+original_branch_id).replaceWith( newRow );
                    }
                    $('#form_addLeaveType').trigger("reset");
                    $('#modal-add').modal('hide');
                    
                },
                error: function (data) {
                    alert(JSON.stringify(data));
                    // alert('Error: '+JSON.stringify(data));
                    // console.log('Error:', JSON.stringify(data));
                }
            });

        }

        
    });

</script>
@endsection