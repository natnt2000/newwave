@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Faculty List</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href={{ route('faculties.create') }} class="btn btn-primary float-right mb-3">Create</a>
                <div class="col-6">
                    @include('message')
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($faculties as $key => $faculty)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td id="faculty-name-{{$faculty->id}}">{{$faculty->name}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-info mr-2" role="button"
                                       href="{{ route('faculties.edit', $faculty->slug) }}">Edit</a>
                                    <form id="faculty-destroy-form"
                                          action="{{ route('faculties.destroy', $faculty->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" type="submit"
                                                onclick="return confirm('Do you want delete this faculty ?')">Remove
                                        </button>
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$faculties->links()}}
            </div>
        </div>
    </div>
@endsection
