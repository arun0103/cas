@extends('layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('status') }}
    </div>
@endif
<div class="row roundPadding20" id="addNewCategory"> 
    <div class="col-sm-12">
        <form class="form-horizontal" method="post" action="/addCategory">
        {{csrf_field()}}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputCategoryId" class="col-sm-4 control-label">Category ID</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputCategoryId" placeholder="Category ID" name="category_id">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="category_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputMaxLateTime" class="col-sm-2 control-label">Max Late Time Allowed</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputMaxLateTime" placeholder="Max Late Time Allowed (in minutes)" name="maxLateAllowed">
                </div>
            </div>
            <div class="form-group">
                <label for="inputMaxEarlyTime" class="col-sm-2 control-label">Max Early Time Allowed</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputMaxEarlyTimete" placeholder="Max Early Time Allowed (in minutes)" name="maxEarlyAllowed">
                </div>
            </div>
            <div class="form-group">
                <label for="inputMaxShortLeave" class="col-sm-2 control-label">Max Short Leave Allowed</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputMaxShortLeave" placeholder="Max Short Leave Allowed (in days)" name="maxShortLeaveAllowed">
                </div>
            </div>
            <div class="form-group">
                <label for="inputMinWorkingDaysWeeklyOff" class="col-sm-2 control-label">Min Working Days Weekly Off</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputMinWorkingDaysWeeklyOff" placeholder="Min Working Days Weekly Off" name="minWorkingDaysWeeklyOff">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Weekly Off Cover</label>
                <div class="col-sm-8">
                    <label for="radio_yes">Yes
                        <input type="radio" id="radio_yes" name="weeklyOffCover" value="1" class="flat-red" checked>
                    </label>
                    <label for="radio_no">No
                        <input type="radio" id="radio_no" name="weeklyOffCover" value="0" class="flat-red">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Paid Holiday Cover</label>
                <div class="col-sm-8">
                    <label for="radio_yes">Yes
                        <input type="radio" id="radio_yes" name="paidHolidayCover" value="1" class="flat-red" checked>
                    </label>
                    <label for="radio_no">No
                        <input type="radio" id="radio_no" name="paidHolidayCover" value="0" class="flat-red">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
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