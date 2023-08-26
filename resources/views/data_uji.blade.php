@extends('layout.admin')

@section('content')

<title>Data Uji</title>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Uji</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Uji</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-auto">
    <div class="card col-auto">
      <div class="card-header col-auto">
        <h3 class="card-title text-center">Daftar Data Uji</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body col-auto">

        {{-- @if(auth()->user()->akses === 'Admin') hanya bisa diakses Admin --}}
        @if(auth()->user()->akses === 'Admin')
        <a button type="button" class="btn btn-success" href="/create_data_uji">Tambah +</button> </a>
        @endif

        {{-- {{ Session::get('page_url') }} --}}

        <div class="row g-3 d-flex flex-row-reverse">
          <div class="col-auto">
            <form action="/data_uji" method="GET">
            <input type="search" value="{{ $searchQuery }}" name="search" placeholder="Cari Data..." class="form-control text-left">
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

          <div class="col-auto">
            <form action="/data_uji" method="GET">
              <a href="/export_excel_uji" class="btn btn-success">Export Excel</button> </a>
            </form>
          </div>

          <!-- Button trigger modal -->
          @if(auth()->user()->akses === 'Admin')
          <div class="col-auto">
            <form action="" method="">
              <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import Excel
              </button>
            </form>
          </div>
          @endif

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel Data uji</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="uji_excel_import" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                   <div class="form-group">
                      <input type="file" name="file_uji" required>
                      <p>
                        Harap perhatikan file excel dan array field didalamnya
                      </p>
                   </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>

                </form>
              </div>
            </div>
          </div>

          {{-- overflow untuk bisa mengscroll table --}}
          <div style="overflow-x: auto;">
            <table class="table table-bordered mt-3">
            <thead>
                <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Password</th>
                <th scope="col">Tanggal_masuk</th>
                <th scope="col">Status</th>
                <th scope="col">Foto1</th>

                @if(auth()->user()->akses === 'Admin')
                <th scope="col">Foto2</th>
                <th scope="col">Dimasukan Oleh</th>
                <th scope="col">Diperbaharui Oleh</th>
                @endif

                <th scope="col">Tanggal Data Dibuat</th>
                <th scope="col">Action</th>
            </tr>
            </thead>

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
                        <img src="{{ asset('uji_foto/Foto1/' . $row->Foto1) }}" alt="Foto1" style="width: 40px;">
                        {{-- <img src="{{ asset('storage/folder_foto1/' . $row->Foto1) }}" alt="Foto 1" style="width: 40px;"> --}}
                    @endif
                    </td>

                @if(auth()->user()->akses === 'Admin')
                    <td>
                    @if ($row->Foto2)
                        <img src="{{ asset('uji_foto/Foto2/' . $row->Foto2) }}" alt="Foto2" style="width: 40px;">
                        {{-- <img src="{{ asset('storage/folder_foto2/' . $row->Foto2) }}" alt="Foto 2" style="width: 40px;"> --}}
                    @endif
                    </td>
                    <td>{{$row->inserted_by_email }}</td>
                    <td>{{$row->updated_by_email }}</td>
                @endif

                    <td>{{$row->created_at->format('D,d M Y')}}</td>

                    <td>
                    @if(auth()->user()->akses === 'Admin')
                    <a href="/edit_data_uji/{{$row->id}}" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Edit</a>
                    @endif

                    <a href="/lihat_data_uji/{{$row->id}}" class="btn btn-secondary btn-sm mt-2"><i class="fas fa-eye"></i>Lihat</a>

                    @if(auth()->user()->akses === 'Admin')
                    <a href="#" class="btn btn-danger btn-sm delete mt-2" data-id="{{$row->id}}" data-kode="{{$row->Kode}}" data-nama="{{$row->Nama}}"><i class="fas fa-trash-alt"></i>Hapus</a>
                    @endif

                    </td>

                </tr>
                @endforeach
                </tr>
            </tbody>
            </table>
          </div>

      </div>

      <!-- /.card-body -->
      <div class="card-footer col-auto">
          <!-- syntax pembatsan menu pagination -->
          {{ $data_uji->links() }}
      </div>
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
        toastr.success('Data Sudah Disimpan!', 'Berhasil');

    @endif

  </script>

  <!-- syntax pemberitahuan bahwa data telah diubah -->
  <script>

    @if (Session::has('success_edit'))

        // Set a success toast, with a title
        toastr.success('Data Sudah Diubah!', 'Berhasil');

    @endif

  </script>

</div>

@endsection
