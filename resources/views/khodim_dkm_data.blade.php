@extends('layout.admin')

@section('content')
    <title>Data Khodim DKM</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Khodim DKM</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><a href="/khodim_dkm_data">Data Khodim DKM</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="col-auto">
            <div class="card col-auto">
                <div class="card-header col-auto">
                    <h3 class="card-title text-center">Daftar Data Khodim DKM</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body col-auto">

                    @if (auth()->user()->akses === 'Admin')
                        <a button type="button" class="btn btn-success" href="/khodim_dkm_create">Tambah Data</button> </a>
                    @endif

                    {{-- {{ Session::get('page_url') }} --}}

                    <div class="row g-3 d-flex flex-row-reverse">
                        <div class="col-auto">
                            <form action="/khodim_dkm_data" method="GET">
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
                            <form action="/khodim_dkm_data" method="GET">
                                <a href="/khodim_dkm_export_pdf" class="btn btn-primary">Export PDF</button> </a>
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

                            table.table-khodim_dkm thead tr {
                                background-color: #0c613b;
                                /* Header background color */
                                color: #ffffff;
                                /* Header text color */
                            }

                            table.table-khodim_dkm tbody tr:nth-child(odd) {
                                background-color: #343A40;
                                /* Lighter color for odd rows */
                            }

                            table.table-khodim_dkm tbody tr:nth-child(even) {
                                background-color: #3e454d;
                                /* Default color for even rows */
                            }

                            table.table-khodim_dkm th,
                            table.table-khodim_dkm td {
                                color: #ffffff;
                                /* Set the text color using CSS variable */
                                padding: 10px;
                                /* Adjust the padding value as needed */
                            }
                        </style>
                        {{-- akhir css table --}}


                        {{-- List table content --}}
                        <div class="table-container">
                            <table class="table-khodim_dkm table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Kode Khodim</th>
                                        <th scope="col">Divisi Khodim</th>
                                        <th scope="col">Nama Khodim</th>
                                        <th scope="col">Kontak Khodim</th>
                                        <th scope="col">Alamat Khodim</th>
                                        <th scope="col">Foto Khodim</th>
                                        <th scope="col">Identitas Khodim</th>
                                        <th scope="col">Keterangan Khodim</th>
                                        <th scope="col">Status Khodim</th>

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
                                        @foreach ($khodim_dkm_data as $khodim_dkm_index => $row)
                                    <tr>
                                        <!-- daftar nomor urut -->
                                        <td>{{ $khodim_dkm_index + $khodim_dkm_data->firstItem() }}</td>


                                        <th scope="row">{{ $row->Kode_Khodim }}</th>

                                        {{-- memanggil dan mengecek kesediaan data kode_bidang_khodim
                                        yang ditampilkan oleh nama bidang_khodim dari table bidang_khodim --}}
                                        @if ($row->ambil_kode_bidang_khodim)
                                            <th scope="row">{{ $row->ambil_kode_bidang_khodim->Nama_Bidang_Khodim }}</th>
                                        @else
                                            <th scope="row">Divisi Tidak Diketahui</th>
                                        @endif

                                        <td>{{ $row->Nama_Khodim }}</td>
                                        <td>{{ $row->Kontak_Khodim }}</td>
                                        <td>{{ $row->Alamat_Khodim }}</td>


                                        <td>
                                            @if ($row->Foto_Khodim)
                                                <img src="{{ asset('Data_Khodim/Foto_Khodim/' . $row->Foto_Khodim) }}"
                                                    alt="Foto_Khodim" style="width: 40px;">
                                            @endif
                                        </td>

                                        @if (auth()->user()->akses === 'Admin')
                                            <td>
                                                @if ($row->Identitas_Khodim)
                                                    <img src="{{ asset('Data_Khodim/Identitas_Khodim/' . $row->Identitas_Khodim) }}"
                                                        alt="Identitas_Khodim" style="width: 40px;">
                                                @endif
                                            </td>
                                        @endif

                                        <td>{{ $row->Keterangan_Khodim }}</td>
                                        <td>{{ $row->Status_Khodim }}</td>

                                        @if (auth()->user()->akses === 'Admin')
                                            <td>{{ $row->inserted_by }}</td>
                                            <td>{{ $row->updated_by }}</td>

                                            <td>{{ $row->created_at->format('D, d M Y H:i:s') }}</td>
                                            <td>{{ $row->updated_at->format('D, d M Y H:i:s') }}</td>
                                        @endif

                                        <td>
                                            @if (auth()->user()->akses === 'Admin')
                                                <a href="/khodim_dkm_edit/{{ $row->id_khodim }}"
                                                    class="btn btn-primary btn-sm"><i class="fas fa-pen"></i>Edit</a>
                                            @endif
                                            <a href="/khodim_dkm_view/{{ $row->id_khodim }}" target="_blank"
                                                class="btn btn-secondary btn-sm mt-2"><i class="fas fa-eye"></i>Lihat</a>
                                            {{-- <a href="#" class="btn btn-danger btn-sm delete mt-2" data-id="{{$row->id}}" data-kode="{{$row->Kode}}" data-nama="{{$row->Nama}}"><i class="fas fa-trash-alt"></i>Hapus</a> --}}
                                        </td>

                                    </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        {{-- akhir List table content --}}

                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer col-auto">
                        <!-- syntax pembatsan menu pagination -->
                        {{ $khodim_dkm_data->links() }}
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
                $('.delete').click(function() {

                    var ujiid = $(this).attr('data-id');
                    var ujikode = $(this).attr('data-kode');
                    var ujinama = $(this).attr('data-nama');

                    swal({
                            title: "Apakah anda yakin ?",
                            text: "Data yang akan dihapus kode " + ujikode + " Nama " + ujinama + "  ",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location = "/delete_data_uji/" + ujiid + ""
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
