<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Uji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1>Data Uji</h1>

    <div class="container">
    <a button type="button" class="btn btn-success" href="/create_data_uji">Tambah +</button> </a>

    <!-- syntax pemberitahuan bahwa data telah dimasukan -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
         {{$message}}
    </div>
    @endif
    
        <div class="row">
            <table class="table">
             <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Password</th>
                    <th scope="col">Tanggal_masuk</th>
                    <th scope="col">Status</th>
                    <th scope="col">Foto1</th>
                    <th scope="col">Foto2</th>
                    <th scope="col">Tanggal Data Dibuat</th>
                </tr>
              </thead>

              <!-- Menampilkan data table dari database -->
              <tbody>
                <tr>
                    @foreach ($data_uji as $row)
                    <tr>
                      <!-- daftar nomor urut -->
                      <td>{{$loop -> iteration}}</td>

                      <th scope="row">{{$row->Kode}}</th>
                      <td>{{$row->Nama}}</td>
                      <td>{{$row->Password}}</td>
                      <td>{{$row->Tanggal_masuk}}</td>
                      <td>{{$row->Status}}</td>

                      <td>
                        @if ($row->Foto1)
                            <img src="{{ asset('storage/folder_foto1/' . $row->Foto1) }}" alt="Foto 1" style="width: 40px;">
                        @endif
                     </td>
                    
                      <td>
                        @if ($row->Foto2)
                            <img src="{{ asset('storage/folder_foto2/' . $row->Foto2) }}" alt="Foto 2" style="width: 40px;">
                        @endif
                      </td>

                      <td>{{$row->created_at->format('D,d M Y')}}</td>                      
    
                      <td>
                        <a href="/edit_data_uji/{{$row->id}}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>
                        <a href="/delete_data_uji/{{$row->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i>Hapus</a>
                      </td>
    
                    </tr>
                    @endforeach
                  </tr>
                
              </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>