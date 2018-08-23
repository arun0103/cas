@extends('layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('status') }}
    </div>
@endif
<div class="row roundPadding20" id="addNewDepartment"> 
    <div class="col-sm-12">
        <form class="form-horizontal" method="post" action="/addDepartment">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputDepartmentId" class="col-sm-4 control-label">Department ID</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputDepartmentId" placeholder="Department ID" name="department_id">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="department_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div> 
        </form>
    </div>
</div>

@endsection

@section('footer')

@endsection