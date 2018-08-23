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
            <h3 class="box-title">List Of Categories
                <button type="button" id="btn_add" class="btn btn-primary" data-toggle="modal" data-target="#modal-add">Add New</button>
            </h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="categoriesTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Maximum Late Allowed</th>
                    <th>Maximum Early Allowed</th>
                    <th>Maximum Short Leave Allowed</th>
                    <th>Minimum Working Days Weekly Off</th>
                    <th>Weekly Off Cover</th>
                    <th>Paid Holiday Cover</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="categories-list" name="categories-list">
                @foreach ($categories as $category)
                    <tr id="category{{$category->category_id}}">
                        <td>{{$category->category_id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->max_late_allowed}}</td>
                        <td>{{$category->max_early_allowed}}</td>
                        <td>{{$category->max_short_leave_allowed}}</td>
                        <td>{{$category->min_working_days_weekly_off}}</td>
                        <td>@if($category->weekly_off_cover==1)
                            TRUE
                            @else
                            FALSE
                            @endif
                        </td>
                        <td>@if($category->paid_holiday_cover==1)
                            TRUE
                            @else
                            FALSE
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning open_modal" value="{{$category->category_id}}"><i class="fa fa-edit"> </i> Edit</button>
                            <button class="btn btn-danger delete-row" value="{{$category->category_id}}"><i class="fa fa-trash"> </i> Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Maximum Late Allowed</th>
                    <th>Maximum Early Allowed</th>
                    <th>Maximum Short Leave Allowed</th>
                    <th>Minimum Working Days Weekly Off</th>
                    <th>Weekly Off Cover</th>
                    <th>Paid Holiday Cover</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <div class="modal fade" id="modal-add">
        <form id="form_addCategory" class="form-horizontal" method="post" action="/addCategory">
            {{ csrf_field() }}
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row roundPadding20" id="addNewCategory"> 
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputCategoryId" class="control-label">Category ID</label>
                                            <input type="text" class="form-control" id="inputCategoryId" placeholder="Category ID" name="category_id">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputName" class="control-label">Name</label>
                                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="category_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputMaxLateTime" class="control-label">Max Late Time Allowed</label>
                                            <input type="number" class="form-control" id="inputMaxLateTime" placeholder="Max Late Time Allowed (in minutes)" name="maxLateAllowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputMaxEarlyTime" class="control-label">Max Early Time Allowed</label>
                                            <input type="number" class="form-control" id="inputMaxEarlyTime" placeholder="Max Early Time Allowed (in minutes)" name="maxEarlyAllowed">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputMaxShortLeave" class="control-label">Max Short Leave Allowed</label>
                                            <input type="number" class="form-control" id="inputMaxShortLeave" placeholder="Max Short Leave Allowed (in days)" name="maxShortLeaveAllowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputMinWorkingDaysWeeklyOff" class="control-label">Min Working Days Weekly Off</label>
                                            <input type="number" class="form-control" id="inputMinWorkingDaysWeeklyOff" placeholder="Min Working Days Weekly Off" name="minWorkingDaysWeeklyOff">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Weekly Off Cover</label>
                                            <div class="col-sm-12">
                                                <label for="radio_yes">Yes
                                                    <input type="radio" id="radio_weeklyOffCover_yes" name="weeklyOffCover" value="1" class="flat-red" checked>
                                                </label>
                                                <label for="radio_no">No
                                                    <input type="radio" id="radio_weeklyOffCover_no" name="weeklyOffCover" value="0" class="flat-red">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Paid Holiday Cover</label>
                                            <div class="col-sm-12">
                                                <label for="radio_yes">Yes
                                                    <input type="radio" id="radio_paidHolidayCover_yes" name="paidHolidayCover" value="1" class="flat-red" checked>
                                                </label>
                                                <label for="radio_no">No
                                                    <input type="radio" id="radio_paidHolidayCover_no" name="paidHolidayCover" value="0" class="flat-red">
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
            <!-- /.modal-dialog -->"
        </form>
    </div>
@endsection

@section('footer')
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#categoriesTable').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'scrollX'     : true
        });
        $('.loading').hide();
    });
    var state;
        
    //Opening Add Modal
    $('#btn_add').click(function(){
        state="add";
        $('#error_msg_id').removeClass('error').addClass('no-error');
        $('#btn_confirm').val("add");
        $('#btn_confirm').text("Add");
        $('#modal-title').text('Add Categories');
        $('#form_addCategory').trigger("reset");
        $('#modal-add').modal('show');
    });
    //Opening Edit Modal
    $(document).on('click', '.open_modal', function(){
        state="update";
        $('#error_msg_id').removeClass('error').addClass('no-error');
        var category_id = $(this).val();
        $.get('/getCategoryById/' + category_id, function (data) {
            //success data
            console.log(data);
            original_category_id = category_id;
            
            $('#inputCategoryId').val(data.category_id);
            $('#inputName').val(data.name);
            $('#inputMaxLateTime').val(data.max_late_allowed);
            $('#inputMaxEarlyTime').val(data.max_early_allowed);
            $('#inputMaxShortLeave').val(data.max_short_leave_allowed);
            $('#inputMinWorkingDaysWeeklyOff').val(data.min_working_days_weekly_off);

            if(data.weekly_off_cover==0)
                $('#radio_weeklyOffCover_no').prop("checked", true);
            else
                $('#radio_weeklyOffCover_yes').prop("checked", true);
            if(data.paid_holiday_cover==0)
                $('#radio_paidHolidayCover_no').prop("checked", true);
            else
                $('#radio_paidHolidayCover_yes').prop("checked", true);
            
            $('#btn_confirm').val("update");
            $('#btn_confirm').text("Update");
            $('#modal-title').text('Edit Categories');
            $('#modal-add').modal('show');
        });
    });

    //delete department and remove it from list
    $(document).on('click','.delete-row',function(){
        if(confirm('You are about to delete a Category. Are you sure?')){
            var id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "DELETE",
                url: '/deleteCategory/' + id,
                success: function (data) {
                    $("#category" + id).remove();
                },
                error: function (data) {
                    console.error('Error:', data);
                }
            });
        }
        
    });
    
    
    var old_leave_type_id;
    //Detecting change on edit
    $(document).on('focusin', '#inputCategoryId', function(){
            //console.log("Saving value " + $(this).val());
            $(this).data('val', $(this).val());
        }).on('change','#inputCategoryId', function(){
            var current = $(this).val();
            if(state=="update"){
                if($('[id=category'+original_category_id+']').length>0 && original_category_id !=current && $('[id=category'+current+']').length>0){
                    $('#error_msg_id').removeClass('no-error').addClass('error');
                }
                else{
                    $('#error_msg_id').removeClass('error').addClass('no-error');
                }
            }else if(state=="add"){
                if($('[id=category'+current+']').length>0){
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
        var leave_type_id = $('#inputCategoryId').val();
        var url = '/addCategory'; // by default add category
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        e.preventDefault(); 
        var checked_weekly_off_cover, checked_paid_holiday_cover;
        
        if($('#radio_weeklyOffCover_no').prop("checked")==true)
            checked_weekly_off_cover = 0;
        else   
            checked_weekly_off_cover = 1;
        if($('#radio_paidHolidayCover_no').prop("checked")==true)
            checked_paid_holiday_cover = 0;
        else   
            checked_paid_holiday_cover = 1;
        
        var formData = {
            category_id                 : $('#inputCategoryId').val(),
            company_id                  : $('#inputCompanyId').val(),
            name                        : $('#inputName').val(),
            max_late_allowed            : $('#inputMaxLateTime').val(),
            max_early_allowed           : $('#inputMaxEarlyTime').val(),
            max_short_leave_allowed     : $('#inputMaxShortLeave').val(),
            min_working_days_weekly_off : $('#inputMinWorkingDaysWeeklyOff').val(),
            weekly_off_cover            : checked_weekly_off_cover,
            paid_holiday_cover          : checked_paid_holiday_cover,

            
        }
        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn_confirm').val();
        if(state=="add"){
            type = "POST"; 
            url = '/addCategory';
        }else if (state == "update"){
            type = "PUT"; //for updating existing resource
            url = '/updateCategory/' + original_category_id;
        }
        console.log(formData);
        $.ajax({
            type: type,
            url: url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
                var isWeeklyOffCoverTrue, isPaidHolidayCoverTrue;
                if(data.weekly_off_cover==1)
                    isWeeklyOffCoverTrue = 'TRUE';
                else
                    isWeeklyOffCoverTrue = 'FALSE';
                if(data.paid_holiday_cover==1)
                    isPaidHolidayCoverTrue = 'TRUE';
                else
                    isPaidHolidayCoverTrue = 'FALSE';
                var newRow = '<tr id="category' + data.category_id + '"><td>' + data.category_id + '</td><td>'
                            + data.name + '</td><td>'
                            + data.max_late_allowed + '</td><td>'
                            + data.max_early_allowed + '</td><td>'
                            + data.max_short_leave_allowed + '</td><td>'
                            + data.min_working_days_weekly_off + '</td><td>'
                            + isWeeklyOffCoverTrue+ '</td><td>'
                            + isPaidHolidayCoverTrue + '</td>';
                newRow += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.category_id + '"><i class="fa fa-edit"> </i> Edit</button>';
                newRow += ' <button class="btn btn-danger btn-delete delete-row" value="' + data.category_id + '"><i class="fa fa-trash"> </i> Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#categories-list').prepend(newRow);
                }else{ //if user updated an existing record
                    $("#category" + original_category_id).replaceWith( newRow );
                }
                $('#form_addCategory').trigger("reset");
                $('#modal-add').modal('hide');
                console.log(data);
            },
            error: function (data) {
                alert('Error: '+JSON.stringify(data));
                console.log('Error:', JSON.stringify(data));
            }
        });
    });
</script>
@endsection