@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Create New Subject</h1>
    <div class="card shadow mb-4">
        <div class="col-6 mt-3 mb-3">
            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger" >{{ $message }}</span>
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
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    
@endsection