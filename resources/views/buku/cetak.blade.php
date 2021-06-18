<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.heading{
    text-align:center;
    text-decoration: underline;
}
</style>
</head>
<body>

<h2 class="heading">DATA BUKU</h2>

<table>
  <tr>
    <th>NO</th>
    <th>JUDUL</th>
    <th>ISBN</th>
    <th>PENERBIT</th>
    <th>TAHUN TERBIT</th>
    <th>JUMLAH</th>
    <th>DESKRIPSI</th>
    <th>LOKASI</th>
    <th>COVER</th>
  </tr>
  @php
      $no = 1;
  @endphp
  @forelse ($buku as $b )
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $b->judul }}</td>
    <td>{{ $b->isbn }}</td>
    <td>{{ $b->penerbit }}</td>
    <td>{{ $b->tahun_terbit }}</td>
    <td>{{ $b->jumlah }} Buah</td>
    <td>{{ $b->deskripsi }}</td>
    <td>{{ $b->lokasi }}</td>
    <td><img src="{{ asset('cover/'.$b->cover) }}" alt="" width="100" height="100"></td>
  </tr>
  @empty
  <tr>
      <td colspan="9">TIDAK ADA DATA YANG DAPAT DI CETAK</td>
  </tr>
  @endforelse
</table>

</body>
</html>
