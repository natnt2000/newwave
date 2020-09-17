@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Create New Student</h1>
    <div class="card shadow mb-4">
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-6 mt-3 mb-3 ml-2">
                        <div class="form-group">
                            <label for="studentFullnameInput">Fullname</label>
                            <input type="text" id="studentFullnameInput" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}">
                            @error('fullname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="studentEmailInput">Email</label>
                            <input type="email" id="studentEmailInput" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="studentBirthdayInput">Birthday</label>
                            <input type="date" id="studentBirthdayInput" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}">
                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" class="mr-3">Gender</label>
                            <div class="form-check form-check-inline">
                                <input id="maleGender" class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="1" {{ old('gender') == 1 ? "checked" : "" }} >
                                <label class="form-check-label" for="maleGender">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input id="femaleGender" class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="2" {{ old('gender') == 2 ? "checked" : "" }}>
                                <label class="form-check-label" for="femaleGender">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="studentPhoneNumberInput">Phone Number</label>
                            <input type="text" id="studentPhoneNumberInput" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="studentAddressInput">Address</label>
                            <input type="text" id="studentAddressInput" name="address" class="form-control @error('address') is-invalid @enderror" value=" {{old('address')}} ">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="facultyIdSelect">Faculty</label>
                            <select name="faculty_id" id="facultyIdSelect" class="form-control @error('faculty_id') is-invalid @enderror">
                                <option value="" selected>Choose faculty ...</option>
                                @foreach ($faculties as $key => $faculty)
                                    <option value="{{$faculty->id}}" {{ old('faculty_id') == $faculty->id ? "selected" : "" }}>{{$faculty->name}}</option>
                                @endforeach
                            </select>
                            @error('faculty_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="studentAvatarInput">Avatar</label>
                            
                            <input type="file" id="studentAvatarInput" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
    </div>
    
@endsection