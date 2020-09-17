@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Profile</h1>
    <div class="card shadow mb-4">
        <div class="col-6 ml-3 mt-3">
            <div id="alert_after_update_successfully" style="display: none" class="col-12 alert alert-success">
            </div>
            @if(auth()->user()->student)
            <form id="update_profile_form" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h4>Infomation</h4>
                <div class="form-group">
                    <label for="nameUpdate">Name</label>
                    <input type="text" id="nameUpdate" name="fullname" class="form-control"
                           value="{{old('fullname', $student->fullname)}}">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="avatarUpdate">Avatar</label>
                    <img id="avatarGetInfo" src="{{asset('/storage/images/avatars/'.$student->avatar)}}" width="150" alt="">
                    <input type="file" id="avatarUpdate" name="avatar" class="form-control mt-3">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="emailUpdate">Email</label>
                    <input type="text" id="emailUpdate" name="email" class="form-control"
                           value="{{old('email', $student->user->email)}}">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="birthdayUpdate">Birthday</label>
                    <input type="date" id="birthdayUpdate" name="birthday" class="form-control"
                           value="{{old('birthday', $student->birthday)}}">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="" class="mr-2">Gender</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender"
                               value="1" {{old('gender', $student->gender) === MALE ? "checked" : ""}}>
                        <label class="form-check-label" for="">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input " type="radio" name="gender"
                               value="2" {{old('gender', $student->gender) === FEMALE ? "checked" : ""}}>
                        <label class="form-check-label" for="">Female</label>
                    </div>
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="addressUpdate">Address</label>
                    <input type="text" name="address" id="addressUpdate" class="form-control"
                           value="{{old('address', $student->address)}}">
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="phoneNumberUpdate">Phone Number</label>
                    <input type="text" id="phoneNumberUpdate" name="phone_number" class="form-control"
                           value="{{old('phone_number', $student->phone_number)}}">
                    <span class="text-danger"></span>
                </div>
                <button type="submit" class="btn btn-success mb-3">Update</button>
            </form>
            @else
                <h4>Infomation</h4>
                <div class="form-group">
                    <label for="nameUpdate">Name</label>
                    <input type="text" id="nameUpdate" name="name" class="form-control"
                           value="{{auth()->user()->name}}" disabled>
                    <span class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label for="nameUpdate">Email</label>
                    <input type="text" id="nameUpdate" name="email" class="form-control"
                           value="{{auth()->user()->email}}" disabled>
                    <span class="text-danger"></span>
                </div>
            @endif
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('js/change_password.js')}}"></script>
        <script src="{{asset('js/update_profile.js')}}"></script>
    @endpush
@endsection
