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

    <title>Tambah Data Khodim DKM</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Khodim DKM</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/khodim_dkm_data">Data Khodim DKM</a></li>
                            <li class="breadcrumb-item active">Tambah Data Khodim DKM</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/khodim_dkm_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Khodim DKM</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Khodim</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="KHD<?php echo $tgl; ?>" id="" name="Kode_Khodim"
                                                    readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Divisi Khodim</label>
                                                <select class="custom-select rounded-0" id=""
                                                    name="Jabatan_Khodim">
                                                    <option selected disabled value>--Pilih--</option>
                                                    {{-- memanggil variable $bidang_khodim_option yang ada di ruangan controller
                                                    mendefinisikan sebagai variable $Kode_Bidang_Khodim
                                                    yang akan di tampilkan sebagai {{ $Nama_Bidang_Khodim }} di table bidang_khodim --}}
                                                    @foreach ($bidang_khodim_option as $Kode_Bidang_Khodim => $Nama_Bidang_Khodim)
                                                        <option value="{{ $Kode_Bidang_Khodim }}">
                                                            {{ $Nama_Bidang_Khodim }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div name="" class="form-text">Pilih data yang sesuai, Jika tidak ada
                                                    isi data ini <a href="/bidang_khodim_create">Bidang Khodim</a></div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Khodim" class="form-label">Nama Khodim</label>
                                                <input type="text" class="form-control" placeholder="" id=""
                                                    name="Nama_Khodim">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Khodim" class="form-label">Kontak Khodim</label>
                                                <input type="text" class="form-control" placeholder="" id=""
                                                    name="Kontak_Khodim">
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Alamat_Khodim" class="form-label">Alamat Khodim</label>
                                                <textarea class="form-control" name="Alamat_Khodim"></textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Foto_Khodim" class="form-label">Foto Khodim</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Khodim"
                                                        name="Foto_Khodim">
                                                    <label class="custom-file-label" for="exampleInputFile">Foto
                                                        Khodim</label>
                                                </div>
                                            </div>
                                            <script>
                                                $('#Foto_Khodim').on('change', function() {
                                                    // Get the file name
                                                    var fileName = $(this).val();
                                                    // Remove "C:\fakepath\" from the file path
                                                    fileName = fileName.replace("C:\\fakepath\\", "");
                                                    // Replace the "Choose a file" label
                                                    $(this).next('.custom-file-label').html(fileName);
                                                });
                                            </script>

                                            <div class="form-group mb-3">
                                                <label for="Identitas_Khodim" class="form-label">Identitas Khodim</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Identitas_Khodim"
                                                        name="Identitas_Khodim">
                                                    <label class="custom-file-label" for="exampleInputFile">Identitas
                                                        Khodim</label>
                                                </div>
                                                <div name="" class="form-text">Boleh menggunakan KTP atau SIM</div>
                                            </div>
                                            <script>
                                                $('#Identitas_Khodim').on('change', function() {
                                                    // Get the file name
                                                    var fileName = $(this).val();
                                                    // Remove "C:\fakepath\" from the file path
                                                    fileName = fileName.replace("C:\\fakepath\\", "");
                                                    // Replace the "Choose a file" label
                                                    $(this).next('.custom-file-label').html(fileName);
                                                });
                                            </script>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Khodim" class="form-label">Keterangan Khodim</label>
                                                <textarea class="form-control" name="Keterangan_Khodim"></textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Status_Khodim">Status Khodim</label>
                                                <select class="custom-select rounded-0" id="" name="Status_Khodim">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak_Aktif">Tidak_Aktif</option>
                                                    <option value="Lainya">Lainya</option>
                                                </select>
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="khodim_dkm_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
