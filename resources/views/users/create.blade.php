@extends('users.layout')

@section('content')
    <h3>Add Product</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <input type="text" name="id" placeholder="id">
        <input type="text" name="nomor_karyawan" placeholder="No Karyawan">
        <input type="text" name="status" placeholder="Status">
        <input type="text" name="name" placeholder="Nama">
        <input type="text" name="email" placeholder="Email">
        <input type="date" name="email_verified_at" placeholder="Verified">
        <input type="text" name="password" placeholder="Password">
        <input type="text" name="role" placeholder="Role">

                <button type="submit" class="btn btn-success">Add Product</button>

    </form>
@endsection