

<!DOCTYPE html>
<html>
<head>
<style>
#uji {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#uji td, #uji th {
  border: 1px solid #ddd;
  padding: 8px;
}

#uji tr:nth-child(even){background-color: #f2f2f2;}

#uji tr:hover {background-color: #ddd;}

#uji th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Tabel Data Uji</h1>

<table id="uji">
  <tr>
    <th>Nomor</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>Password</th>
    <th>Tanggal_masuk</th>
    <th>Status</th>

    <th>Tanggal Data Dibuat</th>
  </tr>

  @php
      $nomor = 1;
  @endphp

  @foreach ($data_uji as $row)

  <tr>

                      <td>{{$nomor++}}</td>
                      <th scope="row">{{$row->Kode}}</th>
                      <td>{{$row->Nama}}</td>
                      <td>{{$row->Password}}</td>
                      <td>{{$row->Tanggal_masuk}}</td>
                      <td>{{$row->Status}}</td>

                      <td>{{$row->created_at->format('D,d M Y')}}</td> 
  </tr>
  

  @endforeach

  
</table>


</body>
</html>

