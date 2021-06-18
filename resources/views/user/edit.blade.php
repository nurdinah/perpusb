@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Pengguna</h1>


    <div class="row">

        <div class="col-lg-12 mb-4">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit User
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="" class="mb-1">Nama Depan</label>
                            <input type="text" class="form-control py-4" value="{{ $pengguna->name }}" name="name" placeholder="Masukkan Nama" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Nama Belakang</label>
                            <input type="text" class="form-control py-4" value="{{ $pengguna->last_name }}" name="last_name" placeholder="Masukkan Nama Belakang" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Email</label>
                            <input type="email" class="form-control py-4" value="{{ $pengguna->email }}" name="email" placeholder="Masukkan Email" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Password</label>
                            <input type="password" class="form-control py-4" value="{{ old('password') }}" name="password" placeholder="Masukkan Nama Password" required>
                        </div>

                        <div class="form-group">
                          <button class="btn btn-primary btn-sm" type="submit">SIMPAN</button>
                          <a href="{{ route('pengguna.index') }}" class="btn btn-sm btn-danger">KEMBALI</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
