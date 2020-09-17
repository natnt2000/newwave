@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Change Password</h1>
    <div class="card shadow mb-4">
        <div class="col-6 ml-3 mt-3">
            <div id="alert_after_update_successfully" style="display: none" class="col-12 alert alert-success">

            </div>
            <form id="change_password_form" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="currentPass">Current Password</label>
                    <input type="password" id="currentPass" class="form-control" name="current_password">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="newPass">New Password</label>
                    <input type="password" id="newPass" class="form-control" name="password">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="confirmNewPass">Confirm New Password</label>
                    <input type="password" class="form-control" id="confirmNewPass" name="password_confirmation">
                    <span class="text-danger"></span>
                </div>
                <button type="submit" class="btn btn-success mb-3">Update</button>
            </form>
        </div>
    </div>
@endsection
