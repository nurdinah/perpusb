@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">List Pengguna</h1>


    <div class="row">

        <div class="col-lg-12 mb-4">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel User
                        <a href="{{ route('pengguna.create') }}" class="btn btn-sm btn-success float-right">Tambah Data</a>
                        <a href="{{ route('pengguna.cetak') }}" class="btn btn-sm btn-primary float-right">Cetak Pengguna</a>
                    </h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>NO.</th>
                                <th>NAMA LENGKAP</th>
                                <th>EMAIL PENGGUNA</th>
                                <th>AKSI</th>
                            </tr>
                            <?php $no = 1; ?>

                            @forelse ($user as $u)
                            <tr>
                                <td>{{ $no++ }}.</td>
                                <td>{{ $u->name.' '. $u->last_name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-sm btn-warning" href="{{ route('pengguna.edit', $u->id) }}">Edit</a>

                                        <input class="btn btn-sm btn-danger" type="submit" value="Hapus">
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak Ada Data...</td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
