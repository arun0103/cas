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
            <table id="leaveQuotaTable" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Branch</th>
                        <th>Employee</th>
                        <th>Leave</th>
                        <th>Alloted</th>
                        <th>Used</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="leaveQuota-list" name="leaveQuota-list">
                    @foreach($leaveQuotas as $lq)
                        <tr id="lq{{$lq->id}}">
                            <td>{{$lq->branch->name}}</td>
                            <td>{{$lq->employee->name}}</td>
                            <td>{{$lq->leaveMaster->name}}</td>
                            <td>{{$lq->alloted_days}}</td>
                            <td>{{$lq->used_days}}</td>
                            <td>
                                <button class="btn btn-warning open_modal" value="{{$lq->id}}"><i class="fa fa-edit"></i></button>
                                <button class="btn btn-danger delete-row" value="{{$lq->id}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Branch</th>
                        <th>Employee</th>
                        <th>Leave</th>
                        <th>Alloted</th>
                        <th>Used</th>
                        <th>Actions</th>
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
                                            <label for="select_branch">Branch <span class="required">*</span></label>
                                            <select id="select_branch" class="form-control select2 percent100" data-placeholder="Select Branch" name="selectedBranch" onchange="populateEmployee(this.value)" required>
                                                <option></option>
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->branch_id}}">{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label for="select_leave">Leave Type <span class="required">*</span></label>
                                            <select id="select_leave" class="form-control select2 " data-placeholder="Select Leave" name="selectedLeave" required>
                                                <option></option>
                                                @foreach($leaves as $leave)
                                                    <option value="{{$leave->leave_id}}">{{$leave->leaveDetail->name}}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group" >
                                            <label for="select_employee">Employee(s) <span class="required">*</span></label>
                                            <select id="select_employee" class="form-control select2 " multiple data-placeholder="Select Employee(s)" name="selectedEmployees[]" required>
                                                <option></option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputLeaveQuota" class="control-label">Leave Quota <span class="required">*</span></label>
                                            <input type="number" class="form-control" id="inputLeaveQuota" placeholder="Max Leave Days allowed" name="leaveQuota" min="1" required>
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
    <script src="{{asset('js/plugins/jquery/jquery.validate.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#form_addLeaveQuota").validate({
                ignore: "",
                //put error message behind each form element
                errorPlacement: function (error, element) {
                    var elem = $(element);
                    if (element.parent('.input-group').length) { 
                        error.insertAfter(element.parent());      // radio/checkbox?
                    } else if (element.hasClass('select2')) {     
                        error.insertAfter(element.next('span'));  // select2
                    } else {                                      
                        error.insertAfter(element);               // default
                    }; 
                }
            });
            //Initialize Select2 Elements
            $('.select2').select2({
                allowClear: true
            });
            //Initialize Datatables
            $('#leaveQuotaTable').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : true,
                "scrollX"     : true,
            });

            $('.loading').hide();
        });
        function populateEmployee(branch){
            if(branch != []){
                $('#select_employee').empty();
                $.get('/employees/branch/'+branch, function(data){
                    $.each(data, function(key,val){
                        $('#select_employee').append('<option value="'+val.employee_id+'">'+val.name+'</option');
                    });
                });
            }
        }
        var original_leave_id;
        //Opening Edit Modal
        $(document).on('click', '.open_modal', function(){
            state="update";
            var id = $(this).val();
            $.get('/getLeaveQuotaById/' + id, function (data) {
                //success data
                original_leave_id = id;
                $('#select_branch').prop("disabled",true).val(data.branch_id).change();
                $('#select_employee').prop("disabled",true).val(data.employee_id).change();
                $('#select_leave').val(data.leave_id).change();
                $('#inputLeaveQuota').val(data.alloted_days);
                
                $('#btn_confirm').val("update");
                $('#btn_confirm').text("Update");
                $('#modal-title').text('Edit Leave Quota');
                $('#modal-add').modal('show');
            }); 
        });
        //Opening Add Modal
        $('#btn_add').click(function(){
            state="add";
        
            $('#error_msg_id').removeClass('error').addClass('no-error');

            $('#select_branch').val([]).trigger('change');
            $('#select_leave').val([]).trigger('change');
            $('#select_employee').val([]).trigger('change');

            $('#btn_confirm').val("add");
            $('#btn_confirm').text("Add");
            $('#modal-title').text('Add Leave Quota');
            $('#form_addLeaveQuota').trigger("reset");
            $('#modal-add').modal('show');
        });
        
        //create new product / update existing product
        $("#btn_confirm").click(function (e) {
            e.preventDefault();
            if($("#form_addLeaveQuota").valid()) {
                var type = "POST"; //for creating new resource
                var leave_type_id = $('#select_leave').val();
                var url = '/addLeaveQuota'; // by default add department
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = {
                    company_id              : $('#inputCompanyId').val(),
                    branch_id               : $('#select_branch').val(),
                    leave_id                : $('#select_leave').val(),
                    employees               : $('#select_employee').val(),
                    alloted_days            : $('#inputLeaveQuota').val()
                }
                //used to determine the http verb to use [add=POST], [update=PUT]
                var state = $('#btn_confirm').val();
                if(state=="add"){
                    type = "POST"; 
                    url = '/addLeaveQuota';
                }else if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    url = '/updateLeaveQuota/' + original_leave_id;
                }
                //console.log(formData);
                $.ajax({
                    type: type,
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (state == "add"){ //if user added a new record
                            $.each(data.data, function(key,val){
                                var newRow = '<tr id="lq' + val.id + '">'
                                    +'<td>' + val.branch.name + '</td>'
                                    +'<td>' + val.employee['name'] + '</td>'
                                    +'<td>' + val.leave_master['name']+'</td>'
                                    +'<td>' + val.alloted_days+'</td>'
                                    +'<td>' + val.used_days+'</td>';
                                newRow += '<td><button class="btn btn-warning btn-detail open_modal" value="' + val.id + '"><i class="fa fa-edit"></i></button>';
                                newRow += ' <button class="btn btn-danger btn-delete delete-row" value="' + val.id + '"><i class="fa fa-trash"></i></button></td></tr>';
                                $('#leaveQuota-list').prepend(newRow);
                            });
                            alert(data.success + ' out of '+data.total + ' added!');
                        }else{ //if user updated an existing record
                            var newRow = '<tr id="lq' + data.id + '">'
                                +'<td>' + data.branch.name + '</td>'
                                +'<td>' + data.employee['name'] + '</td>'
                                +'<td>' + data.leave_master['name']+'</td>'
                                +'<td>' + data.alloted_days+'</td>'
                                +'<td>' + data.used_days+'</td>';
                            newRow += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '"><i class="fa fa-edit"></i></button>';
                            newRow += ' <button class="btn btn-danger btn-delete delete-row" value="' + data.id + '"><i class="fa fa-trash"></i></button></td></tr>';
                            $('#lq' + original_leave_id).replaceWith( newRow );
                        }
                        $('#form_addLeaveQuota').trigger("reset");
                        $('#modal-add').modal('hide');
                        
                    },
                    error: function (data) {
                        alert(JSON.stringify(data));
                        // alert('Error: '+JSON.stringify(data));
                        // console.log('Error:', JSON.stringify(data));
                    }
                }); 
            } else{
                alert("Data Missing!\n\nPlease verify and try again");
            }        
        });
        //delete department and remove it from list
        $(document).on('click','.delete-row',function(){
            if(confirm('You are about to delete a Leave quota of an Employee. Are you sure?')){
                var id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: '/deleteLeaveQuota/' + id,
                    success: function (data) {
                        $("#lq" + id).remove();
                    },
                    error: function (data) {
                        alert("Something went wrong! \nPlease try again after some time!")
                        console.error('Error:', data);
                    }
                });
            }
            
        });
    </script>
@endsection