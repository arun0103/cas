@extends('layouts.master')

@section('head')
<link rel="stylesheet" href="{{asset('js/plugins/datatables/css/dataTables.bootstrap4.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
    <div class="loading">Loading&#8230;</div>
    <div>
        <input type="hidden" id="inputCompanyId" disabled value="{{Session::get('company_id')}}">
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List Of Designations
                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New</button>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="designationTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Designation Name</th>
                    <th>Designation ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="designations-list" name="designations-list">
            @foreach($designations as $designation)
                <tr id='designation{{$designation->designation_id}}'>
                    <td>{{$designation->name}}</td>
                    <td>{{$designation->designation_id}}</td>
                    <td>
                        <button class="btn btn-warning open_modal" value="{{$designation->designation_id}}"><i class="fa fa-edit"> </i> Edit</button>
                        <button class="btn btn-danger delete-row" value="{{$designation->designation_id}}"><i class="fa fa-trash"> </i> Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Designation Name</th>
                    <th>Designation ID</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="modal fade" id="modal-add">
        <form id="form_addDesignation" class="form-horizontal" method="post" action="/addDesignation">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg" style="width:90% !important;height:90% !important; padding:0;margin:0 auto">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add Designation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputDesignationId" class="control-label">Designation ID</label>
                                    <input type="text" class="form-control" id="inputDesignationId" placeholder="Designation ID" name="designation_id">
                                    <span id="error_msg_id">Designation ID is already used</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputName" class="control-label">Designation Name</label>
                                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="designation_name">
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
<script>
    $(document).ready(function() {
        $('#designationTable').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        });
        $('.loading').hide();
    });
  
    var original_designation_id;
    var state;
    var company_id;
    //Opening Add Modal
    $('#btn_add').click(function(){
        state="add";

        $('#error_msg_id').removeClass('error').addClass('no-error');
        $('#form_addDesignation').trigger("reset");
        $('#btn_confirm').val("add");
        $('#btn_confirm').text("Add");
        $('#modal-title').text('Add Designation');
        $('#modal-add').modal('show');    
    });
    //Opening Edit Modal
    $(document).on('click', '.open_modal', function(){
        state="update";
        $('#error_msg_id').removeClass('error').addClass('no-error');
        var designation_id = $(this).val();
        $.get('/getDesignationById/' + designation_id, function (data) {
            //success data
            original_designation_id = designation_id;
            console.log(data);
            $('#inputDesignationId').val(data.designation_id);
            $('#inputName').val(data.name);
            $('#btn_confirm').val("update");
            $('#btn_confirm').text("Update");
            $('#modal-title').text('Edit Designation');
            $('#modal-add').modal('show');
        }) 
    });

    //delete designation and remove it from list
    $(document).on('click','.delete-row',function(){
        if(confirm('You are about to delete a designation. Are you sure?')){
            var designation_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: '/deleteDesignation/' + designation_id,
                success: function (data) {
                    $("#designation" + designation_id).remove();
                },
                error: function (data) {
                    console.error('Error:', data.responseJSON);
                }
            });
        }
        
    });
    
    
    var old_designation_id;
    //Detecting change on edit
    $(document).on('focusin', '#inputDesignationId', function(){
        $(this).data('val', $(this).val());
    }).on('change','#inputDesignationId', function(){
        var current = $(this).val();
        if(state=="update"){
            if($('[id=designation'+original_designation_id+']').length>0 && original_designation_id !=current && $('[id=designation'+current+']').length>0){
                $('#error_msg_id').removeClass('no-error').addClass('error');
            }else{
                $('#error_msg_id').removeClass('error').addClass('no-error');
            }
        }
        else if(state=="add"){
            if($('[id=designation'+current+']').length>0){
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
        var designation_id = $('#inputDesignationId').val();
        var url = '/addDesignation'; // by default add designation
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var formData = {
            designation_id       : $('#inputDesignationId').val(),
            name                : $('#inputName').val(),
            company_id          : $('#inputCompanyId').val()
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn_confirm').val();
        if(state=="add"){
            type = "POST"; 
            url = '/addDesignation';
        }else if (state == "update"){
            type = "PUT"; //for updating existing resource
            url = '/updateDesignation/' + original_designation_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var designation = '<tr id="designation' + data.designation_id + '"><td>' + data.name + '</td><td>' + data.designation_id + '</td>';
                designation += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.designation_id + '"><i class="fa fa-edit"> </i> Edit</button>';
                designation += ' <button class="btn btn-danger btn-delete delete-row" value="' + data.designation_id + '"><i class="fa fa-trash"> </i> Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#designations-list').append(designation);
                }else{ //if user updated an existing record
                    $("#designation" + original_designation_id).replaceWith( designation );
                }
                $('#form_addDesignation').trigger("reset");
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