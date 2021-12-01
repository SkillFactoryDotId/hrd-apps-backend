@extends('users.layout')

@section('content')
        <h3>User</h3>
        <a class="btn btn-success" href="{{ route('users.create') }}">Add Product</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No Karyawan</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Email</th>
            <th>Status</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->no_karyawan }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $users->links() !!}

@endsection