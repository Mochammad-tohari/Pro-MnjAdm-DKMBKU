@extends('layout.admin')

@section('content')
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
    </script>

    <title>Tambah Data Uji Bidang</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Uji Bidang</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/bidang_khodim_data">Data Uji Bidang</a></li>
                            <li class="breadcrumb-item active">Tambah Data Uji Bidang</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/uji_bidang_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Uji Bidang</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Bidang</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="UJBD-<?php echo $tgl; ?>" id="" name="Kode_Bidang"
                                                    readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Bidang" class="form-label">Nama Bidang
                                                    Khodim</label>
                                                <input type="text" class="form-control" placeholder="" id="Nama_Bidang"
                                                    name="Nama_Bidang" value="{{ old('Nama_Bidang') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Bidang')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Bidang" class="form-label">Keterangan Bidang</label>
                                                <textarea class="form-control" name="Keterangan_Bidang" id="Keterangan_Bidang">{{ old('Keterangan_Bidang') }}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Status_Bidang">Status Bidang Khodim</label>
                                                <select class="custom-select rounded-0" id="Status_Bidang"
                                                    name="Status_Bidang">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif"
                                                        {{ old('Status_Bidang') == 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Tidak_Aktif"
                                                        {{ old('Status_Bidang') == 'Tidak_Aktif' ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                    <option value="Lainya"
                                                        {{ old('Status_Bidang') == 'Lainya' ? 'selected' : '' }}>Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Bidang')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/uji_bidang_data_new" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->


                        {{-- css utk design table  --}}
                        <style>
                            /* overflow untuk bisa mengscroll table  */
                            div.table-container {
                                overflow-x: auto;
                                max-height: 500px;
                                overflow-y: auto;
                                margin-top: 20px;
                            }

                            table.table-uji_bidang thead tr {
                                background-color: #0c613b;
                                /* Header background color */
                                color: #ffffff;
                                /* Header text color */
                            }

                            table.table-uji_bidang tbody tr:nth-child(odd) {
                                background-color: #343A40;
                                /* Lighter color for odd rows */
                            }

                            table.table-uji_bidang tbody tr:nth-child(even) {
                                background-color: #3e454d;
                                /* Default color for even rows */
                            }

                            table.table-uji_bidang th,
                            table.table-uji_bidang td {
                                color: #ffffff;
                                /* Set the text color using CSS variable */
                                padding: 10px;
                                /* Adjust the padding value as needed */
                            }
                        </style>

                        {{-- card bidang tersedia --}}
                        <div class="card card-danger">
                            <div class="card-header mb-3">
                                <h3 class="card-title">Daftar Bidang Yang Sudah Ada</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                <table class="table-uji_bidang table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kode Bidang</th>
                                            <th scope="col">Nama Bidang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($uji_bidang_data->sortBy('Kode_Bidang') as $row)
                                            <tr>
                                                <td>{{ $row->Kode_Bidang }}</td>
                                                <td>{{ $row->Nama_Bidang }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        {{-- akhir card bidang tersedia --}}
                    @endsection
