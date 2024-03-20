{{-- @extends('layout.admin')
memasukan layout admin.php sebagai tampilan di halaman ini
--}}
@extends('layout.admin')


{{-- @section('content')
memasukan bagian tampilan content dari admin.php sebagai tampilan di halaman ini
--}}
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

    <title>Tambah Data Murid Madrasah</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Murid Madrasah</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/murid_madrasah_data">Data Murid Madrasah</a></li>
                            <li class="breadcrumb-item active">Tambah Data Murid Madrasah</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/murid_madrasah_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Murid Madrasah</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="Kode_Murid" class="form-label">Kode Murid</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="MRD-<?php echo $tgl; ?>" id="Kode_Murid" name="Kode_Murid"
                                                    readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Murid" class="form-label">Nama Murid</label>
                                                <input type="text" class="form-control" placeholder="" id="Nama_Murid"
                                                    name="Nama_Murid" value="{{ old('Nama_Murid') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tempat_Lahir_Murid" class="form-label">Tempat Lahir
                                                    Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Tempat_Lahir_Murid" name="Tempat_Lahir_Murid"
                                                    value="{{ old('Tempat_Lahir_Murid') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Tempat_Lahir_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Lahir_Murid" class="form-label">Tanggal Lahir
                                                    Murid</label>
                                                <input class="form-control" type="date" id="Tanggal_Lahir_Murid"
                                                    name="Tanggal_Lahir_Murid" value="{{ old('Tanggal_Lahir_Murid') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Tanggal_Lahir_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Asal_Sekolah_Murid" class="form-label">Asal Sekolah
                                                    Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Asal_Sekolah_Murid" name="Asal_Sekolah_Murid"
                                                    value="{{ old('Asal_Sekolah_Murid') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Asal_Sekolah_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Ayah_Murid" class="form-label">Nama Ayah Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Ayah_Murid" name="Nama_Ayah_Murid"
                                                    value="{{ old('Nama_Ayah_Murid') }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Ibu_Murid" class="form-label">Nama Ibu Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Ibu_Murid" name="Nama_Ibu_Murid"
                                                    value="{{ old('Nama_Ibu_Murid') }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Wali_Murid" class="form-label">Nama Wali Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Wali_Murid" name="Nama_Wali_Murid"
                                                    value="{{ old('Nama_Wali_Murid') }}">
                                                <div name="" class="form-text">Bisa dikosongkan
                                                    jika sudah ada data orang tua</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Murid" class="form-label">Kontak Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Kontak_Murid" name="Kontak_Murid"
                                                    value="{{ old('Kontak_Murid') }}">
                                                <div name="" class="form-text">Nomor Orang tua/wali murid</div>
                                                {{-- pemberitahuan validator --}}
                                                @error('Kontak_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Alamat_Murid" class="form-label">Alamat Murid</label>
                                                <textarea class="form-control" name="Alamat_Murid" id="Alamat_Murid">{{ old('Alamat_Murid') }}</textarea>
                                                {{-- pemberitahuan validator --}}
                                                @error('Alamat_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Murid" class="form-label">Foto Murid</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Murid"
                                                        name="Foto_Murid">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Murid</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Murid" class="mt-3">
                                                    <img id="Muat_Foto_Murid" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_Murid').on('change', function() {
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
                                                            $('#Muat_Foto_Murid').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Murid').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}

                                            {{-- syntax input gambar dan previewnya --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Akta_Kelahiran_Murid" class="form-label">Foto
                                                    Akta Kelahiran Murid</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="Foto_Akta_Kelahiran_Murid" name="Foto_Akta_Kelahiran_Murid">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Akta Kelahiran Murid</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Akta_Kelahiran_Murid" class="mt-3">
                                                    <img id="Muat_Foto_Akta_Kelahiran_Murid" src="#"
                                                        alt="" style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_Akta_Kelahiran_Murid').on('change', function() {
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
                                                            $('#Muat_Foto_Akta_Kelahiran_Murid').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Akta_Kelahiran_Murid').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}

                                            {{-- syntax input gambar dan previewnya --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_KK_Murid" class="form-label">Foto
                                                    Kartu Keluarga Murid</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_KK_Murid"
                                                        name="Foto_KK_Murid">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Kartu Keluarga Murid</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_KK_Murid" class="mt-3">
                                                    <img id="Muat_Foto_KK_Murid" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_KK_Murid').on('change', function() {
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
                                                            $('#Muat_Foto_KK_Murid').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_KK_Murid').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="exampleSelectRounded0">Tingkat Murid</label>
                                                <select class="custom-select rounded-0" id="Tingkat_Murid"
                                                    name="Tingkat_Murid">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="1_Satu"
                                                        {{ old('Tingkat_Murid') == '1_Satu' ? 'selected' : '' }}>1 Satu
                                                    </option>
                                                    <option value="2_Dua"
                                                        {{ old('Tingkat_Murid') == '2_Dua' ? 'selected' : '' }}>2 Dua
                                                    </option>
                                                    <option value="3_Tiga"
                                                        {{ old('Tingkat_Murid') == '3_Tiga' ? 'selected' : '' }}>3 Tiga
                                                    </option>
                                                    <option value="4_Empat"
                                                        {{ old('Tingkat_Murid') == '4_Empat' ? 'selected' : '' }}>4 Empat
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Tingkat_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Murid" class="form-label">Keterangan Murid</label>
                                                <textarea class="form-control" name="Keterangan_Murid" id="Keterangan_Murid">{{ old('Keterangan_Murid') }}</textarea>
                                                <div name="" class="form-text">Memberikan kejelasan tentang
                                                    status/kondisi murid</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="exampleSelectRounded0">Status Murid</label>
                                                <select class="custom-select rounded-0" id="Status_Murid"
                                                    name="Status_Murid">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif"
                                                        {{ old('Status_Murid') == 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Tidak_Aktif"
                                                        {{ old('Status_Murid') == 'Tidak_Aktif' ? 'selected' : '' }}>Tidak
                                                        Aktif</option>
                                                    <option value="Lainya"
                                                        {{ old('Status_Murid') == 'Lainya' ? 'selected' : '' }}>Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Murid')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <div name="" class="form-text">Pilih Aktif Jika Baru Mendaftar
                                                </div>
                                            </div>


                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/murid_madrasah_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
