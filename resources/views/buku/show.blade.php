@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">List Buku</h1>


    <div class="row">

        <div class="col-lg-12 mb-4">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Buku</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Judul Buku</th>
                                    <td>{{ $buku->judul }}</td>
                                </tr>
                                <tr>
                                    <th>ISBN</th>
                                    <td>{{ $buku->isbn }}</td>
                                </tr>
                                <tr>
                                    <th>Penerbit</th>
                                    <td>{{ $buku->penerbit }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Terbit</th>
                                    <td>{{ $buku->tahun_terbit }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Tersedia</th>
                                    <td>{{ $buku->jumlah }} Buah</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $buku->deskripsi }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $buku->lokasi }}</td>
                                </tr>
                                <tr>
                                    <th>Cover</th>
                                    <td>
                                        <img src="{{ asset('cover/'.$buku->cover) }}" alt="" width="100" height="100">
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
