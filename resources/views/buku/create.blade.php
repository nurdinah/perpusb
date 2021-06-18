@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Buku</h1>


    <div class="row">

        <div class="col-lg-12 mb-4">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Buku
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @include('pesan')

                        <div class="form-group">
                            <label for="" class="mb-1">Judul Buku</label>
                            <input type="text" class="form-control py-4" value="{{ old('judul') }}" name="judul" placeholder="Masukkan Judul" required autofocus>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">ISBN</label>
                            <input type="text" class="form-control py-4" value="{{ old('isbn') }}" name="isbn" placeholder="Masukkan ISBN" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Penerbit</label>
                            <input type="text" class="form-control py-4" value="{{ old('penerbit') }}" name="penerbit" placeholder="Tambahkan Penerbit" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Tahun Terbit</label>
                            <input type="number" class="form-control py-4" value="{{ old('tahun_terbit') }}" name="tahun_terbit" placeholder="Tahun Terbit Buku" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Jumlah</label>
                            <input type="number" class="form-control py-4" value="{{ old('jumlah') }}" name="jumlah" placeholder="Jumlah Buku" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Deskripsi</label>
                            <textarea class="form-control py-4" placeholder="Isikan Deskripsi" name="deskripsi"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Lokasi</label>
                            <select name="lokasi" class="form-control">
                                <option value="rak1">RAK 1</option>
                                <option value="rak2">RAK 2</option>
                                <option value="rak3">RAK 3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="mb-1">Upload Cover Buku</label>
                            <input type="file" name="cover" class="form-control" id="cover">
                        </div>

                        <div class="form-group">
                          <button class="btn btn-primary btn-sm" type="submit">SIMPAN</button>
                          <a href="{{ route('buku.index') }}" class="btn btn-sm btn-danger">KEMBALI</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
