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

    <title>Tambah Data Gedung</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Gedung</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/gedung_data">Data Gedung</a></li>
                            <li class="breadcrumb-item active">Tambah Data Gedung</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/gedung_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Gedung</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Gedung</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="GDG-<?php echo $tgl; ?>" id="Kode_Gedung" name="Kode_Gedung"
                                                    readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Gedung" class="form-label">Nama Gedung</label>
                                                <input type="text" class="form-control" placeholder="" id="Nama_Gedung"
                                                    name="Nama_Gedung" value="{{ old('Nama_Gedung') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Gedung')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Dimensi_Gedung" class="form-label">Dimensi Gedung</label>
                                                <textarea class="form-control" name="Dimensi_Gedung" id="Dimensi_Gedung">{{ old('Dimensi_Gedung') }}</textarea>
                                                {{-- pemberitahuan validator --}}
                                                @error('Dimensi_Gedung')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Operasional_Gedung" class="form-label">Tanggal
                                                    Operasional Gedung</label>
                                                <input class="form-control" type="date" id="Tanggal_Operasional_Gedung"
                                                    name="Tanggal_Operasional_Gedung"
                                                    value="{{ old('Tanggal_Operasional_Gedung') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Tanggal_Operasional_Gedung')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Gedung" class="form-label">Keterangan Gedung</label>
                                                <textarea class="form-control" name="Keterangan_Gedung" id="Keterangan_Gedung">{{ old('Keterangan_Gedung') }}</textarea>
                                            </div>


                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Gedung" class="form-label">Foto Gedung</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Gedung"
                                                        name="Foto_Gedung">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Gedung</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Gedung" class="mt-3">
                                                    <img id="Muat_Foto_Gedung" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_Gedung').on('change', function() {
                                                    // Get the file name
                                                    var fileName = $(this).val();
                                                    // Remove "C:\fakepath\" from the file path
                                                    fileName = fileName.replace("C:\\fakepath\\", "");
                                                    // Replace the "Choose a file" label
                                                    $(this).next('.custom-file-label').html(fileName);

                                                    // Image preview
                                                    if (this.files && this.files[0]) {
                                                        var reader = new FileReader();
                                                        reader.onload = function(e) {
                                                            $('#Muat_Foto_Gedung').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Gedung').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}


                                            <div class="form-group mb-3">
                                                <label for="Status_Gedung">Status_Gedung</label>
                                                <select class="custom-select rounded-0" id="Status_Gedung"
                                                    name="Status_Gedung">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif"
                                                        {{ old('Status_Gedung') == 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Tidak_Aktif"
                                                        {{ old('Status_Gedung') == 'Tidak_Aktif' ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                    <option value="Lainya"
                                                        {{ old('Status_Gedung') == 'Lainya' ? 'selected' : '' }}>Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Gedung')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/gedung_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
