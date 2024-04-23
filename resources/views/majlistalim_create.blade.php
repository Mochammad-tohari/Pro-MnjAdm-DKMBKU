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

    <title>Tambah Data Majlistalim</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Majlistalim</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/majlistalim_data">Data Majlistalim</a></li>
                            <li class="breadcrumb-item active">Tambah Data Majlistalim</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/majlistalim_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Majlistalim</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="Kode_Majlistalim" class="form-label">Kode Majlistalim</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="MJTM-<?php echo $tgl; ?>" id="Kode_Majlistalim"
                                                    name="Kode_Majlistalim" readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Majlistalim" class="form-label">Nama Majlistalim</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Majlistalim" name="Nama_Majlistalim"
                                                    value="{{ old('Nama_Majlistalim') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Majlistalim')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Penanggung_Jawab_Majlistalim" class="form-label">Penanggung
                                                    Jawab Majlistalim</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Penanggung_Jawab_Majlistalim" name="Penanggung_Jawab_Majlistalim"
                                                    value="{{ old('Penanggung_Jawab_Majlistalim') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Penanggung_Jawab_Majlistalim')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Majlistalim" class="form-label">Kontak
                                                    Majlistalim</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Kontak_Majlistalim" name="Kontak_Majlistalim"
                                                    value="{{ old('Kontak_Majlistalim') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Kontak_Majlistalim')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Logo_Majlistalim" class="form-label">Logo Majlistalim</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Logo_Majlistalim"
                                                        name="Logo_Majlistalim">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Logo
                                                        Majlistalim</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Logo_Majlistalim" class="mt-3">
                                                    <img id="Muat_Logo_Majlistalim" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Logo_Majlistalim').on('change', function() {
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
                                                            $('#Muat_Logo_Majlistalim').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Logo_Majlistalim').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}



                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Majlistalim" class="form-label">Keterangan
                                                    Majlistalim</label>
                                                <textarea class="form-control" name="Keterangan_Majlistalim" id="Keterangan_Majlistalim">{{ old('Keterangan_Majlistalim') }}</textarea>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Status_Majlistalim">Status Majlistalim</label>
                                                <select class="custom-select rounded-0" id="Status_Majlistalim"
                                                    name="Status_Majlistalim">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif"
                                                        {{ old('Status_Majlistalim') == 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Tidak_Aktif"
                                                        {{ old('Status_Majlistalim') == 'Tidak_Aktif' ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                    <option value="Lainya"
                                                        {{ old('Status_Majlistalim') == 'Lainya' ? 'selected' : '' }}>Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Majlistalim')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/majlistalim_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
