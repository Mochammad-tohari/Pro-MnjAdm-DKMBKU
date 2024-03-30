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

    <title>Tambah Data Inventaris</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Inventaris</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/inventaris_data">Data Inventaris</a></li>
                            <li class="breadcrumb-item active">Tambah Data Inventaris</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/inventaris_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Inventaris</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="Kode_Inventaris" class="form-label">Kode Inventaris</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="INVS-<?php echo $tgl; ?>" id="Kode_Inventaris"
                                                    name="Kode_Inventaris" readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Inventaris" class="form-label">Nama Inventaris</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Inventaris" name="Nama_Inventaris"
                                                    value="{{ old('Nama_Inventaris') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Inventaris')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Merk_Inventaris" class="form-label">Merk Inventaris</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Merk_Inventaris" name="Merk_Inventaris"
                                                    value="{{ old('Merk_Inventaris') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Merk_Inventaris')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Jenis_Inventaris">Jenis_Inventaris</label>
                                                <select class="custom-select rounded-0" id="Jenis_Inventaris"
                                                    name="Jenis_Inventaris">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Elektronik"
                                                        {{ old('Jenis_Inventaris') == 'Elektronik' ? 'selected' : '' }}>
                                                        Elektronik
                                                    </option>
                                                    <option value="Kendaraan"
                                                        {{ old('Jenis_Inventaris') == 'Kendaraan' ? 'selected' : '' }}>
                                                        Kendaraan</option>
                                                    <option value="Peralatan_Kebersihan"
                                                        {{ old('Jenis_Inventaris') == 'Peralatan_Kebersihan' ? 'selected' : '' }}>
                                                        Peralatan Kebersihan
                                                    </option>
                                                    <option value="Furniture_Perabotan"
                                                        {{ old('Jenis_Inventaris') == 'Furniture_Perabotan' ? 'selected' : '' }}>
                                                        Furniture Perabotan
                                                    </option>
                                                    <option value="Peralatan_Ibadah"
                                                        {{ old('Jenis_Inventaris') == 'Peralatan_Ibadah' ? 'selected' : '' }}>
                                                        Peralatan Ibadah
                                                    </option>
                                                    <option value="Peralatan_Bangunan"
                                                        {{ old('Jenis_Inventaris') == 'Peralatan_Bangunan' ? 'selected' : '' }}>
                                                        Peralatan Bangunan
                                                    </option>
                                                    <option value="Lainya"
                                                        {{ old('Jenis_Inventaris') == 'Lainya' ? 'selected' : '' }}>Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Jenis_Inventaris')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Inventaris" class="form-label">Foto Inventaris</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Inventaris"
                                                        name="Foto_Inventaris">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Gedung</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Inventaris" class="mt-3">
                                                    <img id="Muat_Foto_Inventaris" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_Inventaris').on('change', function() {
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
                                                            $('#Muat_Foto_Inventaris').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Inventaris').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}


                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Faktur_Inventaris" class="form-label">Faktur Inventaris</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Faktur_Inventaris"
                                                        name="Faktur_Inventaris">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Gedung</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Faktur_Inventaris" class="mt-3">
                                                    <img id="Muat_Faktur_Inventaris" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Faktur_Inventaris').on('change', function() {
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
                                                            $('#Muat_Faktur_Inventaris').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Faktur_Inventaris').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}


                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Operasional_Inventaris" class="form-label">Tanggal
                                                    Operasional Inventaris</label>
                                                <input class="form-control" type="date"
                                                    id="Tanggal_Operasional_Inventaris"
                                                    name="Tanggal_Operasional_Inventaris"
                                                    value="{{ old('Tanggal_Operasional_Inventaris') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Tanggal_Operasional_Inventaris')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Inventaris" class="form-label">Keterangan
                                                    Inventaris</label>
                                                <textarea class="form-control" name="Keterangan_Inventaris" id="Keterangan_Inventaris">{{ old('Keterangan_Inventaris') }}</textarea>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Status_Inventaris">Status Inventaris</label>
                                                <select class="custom-select rounded-0" id="Status_Inventaris"
                                                    name="Status_Inventaris">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif"
                                                        {{ old('Status_Inventaris') == 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Tidak_Aktif"
                                                        {{ old('Status_Inventaris') == 'Tidak_Aktif' ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                    <option value="Lainya"
                                                        {{ old('Status_Inventaris') == 'Lainya' ? 'selected' : '' }}>Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Inventaris')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/inventaris_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
