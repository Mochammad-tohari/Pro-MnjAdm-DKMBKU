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

    <div class="row g-3 d-flex flex-row-reverse">
      <div class="col-auto">
        <form action="/data_uji" method="GET">
        <input type="search" value="{{ $searchQuery }}" name="search" placeholder="Cari Data..." class="form-control text-right">
        </form>
      </div>

          {{-- <!-- syntax pemberitahuan bahwa data telah dimasukan -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
         {{$message}}
    </div>
    @endif --}}

      <div class="col-auto">
        <form action="/data_uji" method="GET">
          <a href="/export_pdf_uji" class="btn btn-primary">Export PDF</button> </a>
        </form>
      </div>
    </div>
  
        <div class="row mt-2">
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
                    <th scope="col">Action</th>
                </tr>
              </thead>

              <!-- Menampilkan data table dari database -->
              <tbody>
                <tr>
                    @foreach ($data_uji as $index_uji => $row)
                    <tr>
                      <!-- daftar nomor urut -->
                      <td>{{$index_uji + $data_uji->firstItem() }}</td>

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
                        <a href="/edit_data_uji/{{$row->id}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Edit</a>
                        <a href="/lihat_data_uji/{{$row->id}}" class="btn btn-secondary btn-sm"><i class="fas fa-pen"></i>Lihat</a>
                        <a href="#" class="btn btn-danger btn-sm delete" data-id="{{$row->id}}" data-kode="{{$row->Kode}}" data-nama="{{$row->Nama}}"><i class="fas fa-trash-alt"></i>Hapus</a>
                      </td>
    
                    </tr>
                    @endforeach
                  </tr>
                
              </tbody>
            </table>
            <!-- syntax pembatsan menu pagination -->
            {{ $data_uji->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <!-- memanggil script sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- memanggil script jquery cdn minified -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <!-- memanggil script toastr cdn js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- memanggil script toastr cdn css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  </body>

<!-- memberi fungsi delete dengan sweet alert -->
  <script>

    $('.delete').click(function(){

      var ujiid = $(this).attr('data-id');
      var ujikode = $(this).attr('data-kode');
      var ujinama = $(this).attr('data-nama');

      swal({
          title: "Apakah anda yakin ?",
          text: "Data yang akan dihapus kode "+ujikode+" Nama "+ujinama+"  ",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location = "/delete_data_uji/"+ujiid+""
            swal("Data berhasil dihapus", {
              icon: "success_delete",
            });
          } else {
            swal("Data tidak dihapus");
          }
        });
    })
   
  </script>

<!-- syntax pemberitahuan bahwa data telah dimasukan -->
  <script>

    @if (Session::has('success'))

        // Set a success toast, with a title
        toastr.success('Data Sudah Disimpan!', 'Selamat');

    @endif

  </script>
</html>