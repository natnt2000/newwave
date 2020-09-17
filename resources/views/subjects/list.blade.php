@extends('layouts.main')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">Subject List</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <a href="{{ route('subjects.create') }}" class="btn btn-primary float-right mb-3">Create</a>
            <div class="col-6">
              @include('message')
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Faculty</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Faculty</th>
                    <th>Action</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($subjects as $key => $subject)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$subject->name}}</td>
                      <td>{{$subject->faculty->name}}</td>
                      <td>
                        <div class="btn-group">
                          <a class="btn btn-info mr-2" href="{{ route('subjects.edit', $subject->id) }}" role="button">Edit</a>
                          <form action="{{ route('subjects.destroy', $subject->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Do you want delete this subject ?')">Remove</button>
                          </form>
                        </div>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="float-right">
              {{ $subjects->links() }}
            </div>
          </div>
        </div>
      </div>
@endsection