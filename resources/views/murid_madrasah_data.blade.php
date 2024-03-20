@extends('layout.admin')

@section('content')
    <title>Data Murid Madrasah</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Murid Madrasah</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Murid Madrasah</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-auto">
            <div class="card col-auto">
                <div class="card-header col-auto">
                    <h3 class="card-title text-center">Data Murid Madrasah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body col-auto">

                    {{-- @if (auth()->user()->akses === 'Admin') hanya bisa diakses Admin --}}
                    @if (auth()->user()->akses === 'Admin')
                        <a button type="button" class="btn btn-success" href="/murid_madrasah_create"
                            style="margin-right: 10px;">Tambah Data
                            (Admin)</button>
                        </a>
                    @endif

                    <a button type="button" class="btn btn-outline-info" href="/murid_madrasah_create_public"
                        target="_blank">Tambah Data
                        (Umum)</button>
                    </a>

                    {{-- {{ Session::get('page_url') }} --}}

                    <div class="row g-3 d-flex flex-row-reverse">
                        <div class="col-auto">
                            <form action="/murid_madrasah_data" method="GET">
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
                            <form action="/murid_madrasah_data" method="GET">
                                <a href="/murid_madrasah_export_pdf" class="btn btn-primary">Export PDF</button> </a>
                            </form>
                        </div>

                        {{-- css utk design table  --}}
                        <style>
                            /* overflow untuk bisa mengscroll table  */
                            div.table-container {
                                overflow-x: auto;
                                max-height: 500px;
                                overflow-y: auto;
                                margin-top: 20px;
                            }

                            table.table-murid-madrasah thead {
                                /* Set the position to sticky */
                                position: sticky;
                                top: 0;
                                /* Position the header at the top of the container */
                                background-color: #0c613b;
                                /* Background color of the header */
                                color: #ffffff;
                                /* Text color of the header */
                            }

                            table.table-murid-madrasah tbody tr:nth-child(odd) {
                                background-color: #343A40;
                                /* Lighter color for odd rows */
                            }

                            table.table-murid-madrasah tbody tr:nth-child(even) {
                                background-color: #3e454d;
                                /* Default color for even rows */
                            }

                            table.table-murid-madrasah th,
                            table.table-murid-madrasah td {
                                color: #ffffff;
                                /* Set the text color using CSS variable */
                                padding: 10px;
                                /* Adjust the padding value as needed */
                            }
                        </style>
                        {{-- akhir css table --}}

                        {{-- overflow agar bisa mengscroll table --}}
                        <div class="table-container">
                            <table class="table-murid-madrasah table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Kode Murid</th>
                                        <th scope="col">Nama Murid</th>
                                        <th scope="col">Tempat Lahir Murid</th>
                                        <th scope="col">Tanggal Lahir Murid</th>
                                        <th scope="col">Asal Sekolah Murid</th>
                                        <th scope="col">Nama Ayah Murid</th>
                                        <th scope="col">Nama Ibu Murid</th>
                                        <th scope="col">Nama Wali Murid</th>
                                        <th scope="col">Kontak Murid</th>
                                        <th scope="col">Alamat Murid</th>

                                        <th scope="col">Foto Murid</th>

                                        @if (auth()->user()->akses === 'Admin')
                                            <th scope="col">Foto Akta Murid</th>
                                            <th scope="col">Foto KK Murid</th>
                                        @endif

                                        <th scope="col">Tingkat Murid</th>
                                        <th scope="col">Keterangan Murid</th>
                                        <th scope="col">Status Murid</th>

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
                                        @foreach ($murid_madrasah_data as $murid_madrasah_index => $row)
                                    <tr>
                                        <!-- daftar nomor urut -->
                                        <td>{{ $murid_madrasah_index + $murid_madrasah_data->firstItem() }}</td>

                                        <th scope="row">{{ $row->Kode_Murid }}</th>
                                        <td>{{ $row->Nama_Murid }}</td>
                                        <td>{{ $row->Tempat_Lahir_Murid }}</td>
                                        <td>{{ $row->Tanggal_Lahir_Murid }}</td>
                                        <td>{{ $row->Asal_Sekolah_Murid }}</td>
                                        <td>{{ $row->Nama_Ayah_Murid }}</td>
                                        <td>{{ $row->Nama_Ibu_Murid }}</td>
                                        <td>{{ $row->Nama_Wali_Murid }}</td>
                                        <td>{{ $row->Kontak_Murid }}</td>
                                        <td>{{ $row->Alamat_Murid }}</td>


                                        <td>
                                            @if ($row->Foto_Murid)
                                                <img src="{{ asset('Data_Murid/Foto_Murid/' . $row->Foto_Murid) }}"
                                                    alt="Foto_Murid" style="width: 40px;">
                                            @endif
                                        </td>


                                        @if (auth()->user()->akses === 'Admin')
                                            <td>
                                                @if ($row->Foto_Akta_Kelahiran_Murid)
                                                    <img src="{{ asset('Data_Murid/Foto_Akta_Kelahiran_Murid/' . $row->Foto_Akta_Kelahiran_Murid) }}"
                                                        alt="Foto_Akta_Murid" style="width: 40px;">
                                                @endif
                                            </td>

                                            <td>
                                                @if ($row->Foto_KK_Murid)
                                                    <img src="{{ asset('Data_Murid/Foto_KK_Murid/' . $row->Foto_KK_Murid) }}"
                                                        alt="Foto_KK_Murid" style="width: 40px;">
                                                @endif
                                            </td>
                                        @endif


                                        <td>{{ $row->Tingkat_Murid }}</td>
                                        <td>{{ $row->Keterangan_Murid }}</td>
                                        <td>{{ $row->Status_Murid }}</td>


                                        @if (auth()->user()->akses === 'Admin')
                                            <td>{{ $row->inserted_by }}</td>
                                            <td>{{ $row->updated_by }}</td>
                                            <td>{{ $row->created_at->format('D, d M Y H:i:s') }}</td>
                                            <td>{{ $row->updated_at->format('D, d M Y H:i:s') }}</td>
                                        @endif

                                        <td>
                                            @if (auth()->user()->akses === 'Admin')
                                                <a href="/murid_madrasah_edit/{{ $row->id_murid }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Edit</a>
                                            @endif

                                            <a href="/murid_madrasah_view/{{ $row->id_murid }}" target="_blank"
                                                class="btn btn-secondary btn-sm mt-2"><i class="fas fa-eye"></i>Lihat</a>

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
                        {{ $murid_madrasah_data->links() }}
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
