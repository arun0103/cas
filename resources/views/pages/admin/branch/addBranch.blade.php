@extends('layouts.master')

@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        {{ session('status') }}
    </div>
@endif
<div class="roundPadding20">
<div class="row" id="addNewBranch"> 
    <div class="col-sm-12">
        <form class="form-horizontal" method="post" action="/addBranch" autocomplete="off">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputBranchId" class="control-label">Branch ID</label>
                        <input type="text" class="form-control" id="inputBranchId" placeholder="Branch ID" name="branch_id">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="inputName" class="control-label">Name</label>
                        <div>
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="branch_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputWebsite" class="control-label">Website</label>
                <div>
                    <input type="text" class="form-control" id="inputWebsite" placeholder="Website" name="website">
                </div>
            </div>
            <div class="form-group">
                <label for="inputContactNumber" class="col-sm-2 control-label">Contact Number</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputContactNumber" placeholder="Contact Number" name="contact">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCountry" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCountry" placeholder="Country" name="country">
                </div>
            </div>
            <div class="form-group">
                <label for="inputState" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputState" placeholder="State" name="state">
                </div>
            </div>
            <div class="form-group">
                <label for="inputCity" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCity" placeholder="City" name="city">
                </div>
            </div>
            <div class="form-group">
                <label for="inputStreet_address_1" class="col-sm-2 control-label">Street address 1</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputStreet_address_1" placeholder="Street address 1" name="street_address_1">
                </div>
            </div>
            <div class="form-group">
                <label for="inputStreet_address_2" class="col-sm-2 control-label">Street Address 2</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputStreet_address_2" placeholder="Street Address 2" name="street_address_2">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPostalCode" class="col-sm-2 control-label">Postal Code</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPostalCode" placeholder="Postal Code" name="postalCode">
                </div>
            </div>
            <div class="form-group">
                <label for="inputVATNumber" class="col-sm-2 control-label">VAT Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputVATNumber" placeholder="VAT Number" name="VAT_number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPANNumber" class="col-sm-2 control-label">PAN Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPANNumber" placeholder="PAN Number" name="PAN_number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputRegistrationNumber" class="col-sm-2 control-label">Registration Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputRegistrationNumber" placeholder="Registration Number" name="registration_number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputLatitude" class="col-sm-2 control-label">Latitude</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputLatitude" placeholder="Latitude" name="latitude">
                </div>
            </div>
            <div class="form-group">
                <label for="inputLongitude" class="col-sm-2 control-label">Longitude</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputLongitude" placeholder="Longitude" name="longitude">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Admin Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Admin Email" name="email">
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
</div>

@endsection

@section('footer')

@endsection