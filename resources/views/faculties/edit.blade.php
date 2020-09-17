@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Edit Faculty</h1>
    <div class="card shadow mb-4">
        <div class="col-6 mt-3 mb-3">
            <form action="{{ route('faculties.update', $faculty->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="facultyName">Name</label>
                    <input type="text" name="name" id="facultyName" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $faculty->name) }}">
                    @error('name')
                        <span class="text-danger" >{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection