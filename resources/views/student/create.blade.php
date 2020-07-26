@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Create New Student</h1>
    <div class="card shadow mb-4">
        
            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-6 mt-3 mb-3 ml-2">
                        <div class="form-group">
                            <label for="">Fullname</label>
                            <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror" value="{{ old('fullname') }}">
                            @error('fullname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Birthday</label>
                            <input type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}">
                            @error('birthday')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="" class="mr-3">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="1" {{ old('gender') == 1 ? "checked" : "" }} >
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="2" {{ old('gender') == 2 ? "checked" : "" }}>
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value=" {{old('address')}} ">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Faculty</label>
                            <select name="faculty_id" class="form-control @error('faculty_id') is-invalid @enderror">
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
                            <label for="">Avatar</label>
                            
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">
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