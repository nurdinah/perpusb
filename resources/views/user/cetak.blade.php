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

<h2 class="heading">DATA PENGGUNA</h2>

<table>
  <tr>
    <th>NO</th>
    <th>NAMA LENGKAP</th>
    <th>EMAIL</th>
    <th>TGL. REGISTRASI</th>
  </tr>
  @php
      $no = 1;
  @endphp
  @foreach ($pengguna as $p )
  <tr>
    <td>{{ $no++ }}</td>
    <td>{{ $p->name. ' '. $p->last_name }}</td>
    <td>{{ $p->email }}</td>
    <td>{{ $p->created_at }}</td>
  </tr>
  @endforeach
</table>

</body>
</html>
