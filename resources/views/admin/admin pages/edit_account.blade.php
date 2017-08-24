@extends('layouts.admin_layouts')
@section('act_ad_2','active')
@section('admin_dash')
    <form enctype="multipart/form-data" action="/update_avatar" method="post">
        <div class="form-group">
            <input type="file" name="avatar" class="form-control btn btn-primary">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-success btn-sm">change</button>
        </div>
    </form>
@endsection
