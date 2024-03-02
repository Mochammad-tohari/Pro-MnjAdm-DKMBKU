@extends('layout.admin')

@section('content')
    <title>Data Uji User</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Uji User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="/uji_user_data">Uji User</a> </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-auto">
            <div class="card col-auto">
                <div class="card-header col-auto">
                    <h3 class="card-title text-center">Daftar Data Uji User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body col-auto">

                    {{-- @if (auth()->user()->akses === 'Admin') hanya bisa diakses Admin --}}
                    @if (auth()->user()->akses === 'Admin')
                        <a button type="button" class="btn btn-success" href="/uji_user_create">Tambah Data</button>
                        </a>
                    @endif

                    {{-- {{ Session::get('page_url') }} --}}

                    <div class="row g-3 d-flex flex-row-reverse">
                        <div class="col-auto">
                            <form action="/uji_user_data" method="GET">
                                <input type="search" value="{{ $searchQuery }}" name="search" placeholder="Cari Data..."
                                    class="form-control text-left">
                            </form>
                        </div>

                        {{-- <!-- syntax pemberitahuan bahwa data telah dimasukan -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
            {{$message}}
        </div>
        @endif --}}

                        <div class="col-auto">
                            <form action="/uji_user_data" method="GET">
                                <a href="/uji_user_export_pdf" class="btn btn-primary">Export PDF</button> </a>
                            </form>
                        </div>

                        <div class="col-auto">
                            <form action="/uji_user_data" method="GET">
                                <a href="/uji_user_export_pdf" class="btn btn-success">Export Excel</button> </a>
                            </form>
                        </div>

                        <!-- Button trigger modal -->
                        @if (auth()->user()->akses === 'Admin')
                            <div class="col-auto">
                                <form action="" method="">
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Import Excel
                                    </button>
                                </form>
                            </div>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel Data Bidang Uji
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="uji_bidang_import_excel" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="file" name="file_uji_bidang" required>
                                                <p>
                                                    Harap perhatikan file excel dan array field didalamnya
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- end of modal --}}

                        {{-- css utk design table  --}}
                        <style>
                            /* overflow untuk bisa mengscroll table  */
                            div.table-container {
                                overflow-x: auto;
                                max-height: 500px;
                                overflow-y: auto;
                                margin-top: 20px;
                            }

                            table.table-uji_user thead tr {
                                background-color: #0c613b;
                                /* Header background color */
                                color: #ffffff;
                                /* Header text color */
                            }

                            table.table-uji_user tbody tr:nth-child(odd) {
                                background-color: #343A40;
                                /* Lighter color for odd rows */
                            }

                            table.table-uji_user tbody tr:nth-child(even) {
                                background-color: #3e454d;
                                /* Default color for even rows */
                            }

                            table.table-uji_user th,
                            table.table-uji_user td {
                                color: #ffffff;
                                /* Set the text color using CSS variable */
                                padding: 10px;
                                /* Adjust the padding value as needed */
                            }
                        </style>
                        {{-- akhir css table --}}

                        {{-- table dan kontenya --}}
                        <div class="table-container">
                            <table class="table-uji_user table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Kode Uji User</th>
                                        <th scope="col">Jabatan Uji User</th>
                                        <th scope="col">Nama Uji User</th>
                                        <th scope="col">Password Uji User</th>
                                        <th scope="col">Tanggal Uji User</th>
                                        <th scope="col">Keterangan Uji User</th>

                                        @if (auth()->user()->akses === 'Admin')
                                            <th scope="col">Foto Profil</th>
                                            <th scope="col">Foto Identitas</th>
                                        @endif

                                        <th scope="col">Status Uji User</th>

                                        @if (auth()->user()->akses === 'Admin')
                                            <th scope="col">Dimasukan Oleh</th>
                                            <th scope="col">Diperbaharui Oleh</th>

                                            <th scope="col">Tanggal Data Dibuat</th>
                                            <th scope="col">Tanggal Data Diubah</th>
                                        @endif

                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        @foreach ($uji_user_data as $uji_user_index => $row)
                                    <tr>
                                        <!-- daftar nomor urut -->
                                        <td>{{ $uji_user_index + $uji_user_data->firstItem() }}</td>
                                        <th scope="row">{{ $row->Kode_Uji_User }}</th>

                                        {{-- memanggil dan mengecek kesediaan data kode_uji_bidang
                                        yang ditampilkan oleh nama Nama_Bidang dari table uji_bidang --}}
                                        @if ($row->ambil_kode_uji_bidang)
                                            <th scope="row">{{ $row->ambil_kode_uji_bidang->Nama_Bidang }}
                                            </th>
                                        @else
                                            <th scope="row">Jabatan Tidak Diketahui</th>
                                        @endif

                                        <td>{{ $row->Nama_Uji_User }}</td>
                                        <td>{{ $row->Password_Uji_User }}</td>
                                        <td>{{ $row->Tanggal_Uji_User }}</td>
                                        <td>{{ $row->Keterangan_Uji_User }}</td>

                                        @if (auth()->user()->akses === 'Admin')
                                            <td>
                                                @if ($row->Foto_Profil)
                                                    <img src="{{ asset('Data_Uji_User/Foto_Profil/' . $row->Foto_Profil) }}"
                                                        alt="Foto_Profil" style="width: 40px;">
                                                @endif
                                            </td>

                                            <td>
                                                @if ($row->Foto_Identitas)
                                                    <img src="{{ asset('Data_Uji_User/Foto_Identitas/' . $row->Foto_Identitas) }}"
                                                        alt="Foto_Identitas" style="width: 40px;">
                                                @endif
                                            </td>
                                        @endif

                                        <td>{{ $row->Status_Uji_User }}</td>


                                        @if (auth()->user()->akses === 'Admin')
                                            <td>{{ $row->inserted_by }}</td>
                                            <td>{{ $row->updated_by }}</td>

                                            <td>{{ $row->created_at->format('D, d M Y H:i:s') }}</td>
                                            <td>{{ $row->updated_at->format('D, d M Y H:i:s') }}</td>
                                        @endif

                                        <td>
                                            @if (auth()->user()->akses === 'Admin')
                                                <a href="/uji_user_edit/{{ $row->id_uji_user }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Edit</a>
                                            @endif

                                            <a href="/uji_user_view/{{ $row->id_uji_user }}" target="_blank"
                                                class="btn btn-secondary btn-sm mt-2"><i class="fas fa-eye"></i>Lihat</a>

                                            @if (auth()->user()->akses === 'Admin')
                                                <a href="/uji_user_delete" class="btn btn-danger btn-sm delete mt-2"
                                                    data-id-uji-user="{{ $row->id_uji_user }}"
                                                    data-kode-uji-user="{{ $row->Kode_Uji_User }}"
                                                    data-nama-uji-user="{{ $row->Nama_Uji_User }}">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </a>
                                            @endif

                                        </td>

                                    </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- table dan kontenya --}}

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer col-auto">
                        <!-- syntax pembatsan menu pagination -->
                        {{ $uji_user_data->links() }}
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
            </script>

            <!-- memanggil script sweet alert -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <!-- memanggil script jquery cdn minified -->
            <script src="https://code.jquery.com/jquery-3.7.0.min.js"
                integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            <!-- memanggil script toastr cdn js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
                integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <!-- memanggil script toastr cdn css -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
                integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />


            <!-- memberi fungsi delete dengan sweet alert -->
            <script>
                $('.delete').click(function(event) {
                    event.preventDefault();

                    var uji_id_user = $(this).attr('data-id-uji-user');
                    var uji_kode_uji_user = $(this).attr('data-kode-uji-user');
                    var uji_nama_uji_user = $(this).attr('data-nama-uji-user');

                    swal({
                            title: "Apakah anda yakin ?",
                            text: "Data yang akan dihapus kode " + uji_kode_uji_user + " Nama_User " +
                                uji_nama_uji_user,
                            icon: "warning",
                            buttons: ["Batal", "Hapus"], // Adjust the button labels
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                // Proceed with deletion
                                window.location = "/uji_user_delete/" + uji_id_user;
                            } else {
                                // Cancelled, do nothing or show a message
                                swal("Data tidak dihapus", {
                                    icon: "info",
                                });
                            }
                        });
                });
            </script>

            <!-- syntax pemberitahuan bahwa data telah dihapus -->
            <script>
                @if (Session::has('success_delete'))
                    // Set a success toast, with a title
                    toastr.success('Data Telah Dihapus!', 'Berhasil', {
                        "progressBar": true,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut",
                        "iconClass": "toast-success"
                    });
                @endif
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
