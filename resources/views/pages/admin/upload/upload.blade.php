@extends('layouts.master')

@section('content')
<div class="container">
<div class="row">
<form action="/uploadFile" method="post" enctype="multipart/form-data">
        @csrf
        <div >
            <input type="file" class="form-control-file" name="fileToUpload" id="inputEmployeePhoto" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Please upload a valid file.</small>
        </div>
        <button type="submit">Upload</button>
        
    </form>
</div>
</div>
@endsection