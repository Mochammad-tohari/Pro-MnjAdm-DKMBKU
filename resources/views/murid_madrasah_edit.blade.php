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

    <title>Edit Data Murid Madrasah</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Murid Madrasah</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/murid_madrasah_data">Data Murid Madrasah</a></li>
                            <li class="breadcrumb-item active">Edit Data Murid Madrasah</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/murid_madrasah_update/{{ $murid_madrasah_data->id_murid }}" method="POST"
                        enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Data Murid Madrasah</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="Kode_Murid" class="form-label">Kode Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="{{ $murid_madrasah_data->Kode_Murid }}" id="Kode_Murid"
                                                    name="Kode_Murid" readonly>
                                                <div name="" class="form-text">Tidak Bisa Diubah</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Murid" class="form-label">Nama Murid</label>
                                                <input type="text" class="form-control" placeholder="" id="Nama_Murid"
                                                    value="{{ $murid_madrasah_data->Nama_Murid }}" name="Nama_Murid">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tempat_Lahir_Murid" class="form-label">Tempat Lahir
                                                    Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Tempat_Lahir_Murid"
                                                    value="{{ $murid_madrasah_data->Tempat_Lahir_Murid }}"
                                                    name="Tempat_Lahir_Murid">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Lahir_Murid" class="form-label">Tanggal Lahir
                                                    Murid</label>
                                                <input class="form-control" type="date" id="Tanggal_Lahir_Murid"
                                                    value="{{ $murid_madrasah_data->Tanggal_Lahir_Murid }}"
                                                    name="Tanggal_Lahir_Murid" />
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Asal_Sekolah_Murid" class="form-label">Asal Sekolah
                                                    Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Asal_Sekolah_Murid"
                                                    value="{{ $murid_madrasah_data->Asal_Sekolah_Murid }}"
                                                    name="Asal_Sekolah_Murid">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Ayah_Murid" class="form-label">Nama Ayah Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Ayah_Murid" value="{{ $murid_madrasah_data->Nama_Ayah_Murid }}"
                                                    name="Nama_Ayah_Murid">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Ibu_Murid" class="form-label">Nama Ibu Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Ibu_Murid" value="{{ $murid_madrasah_data->Nama_Ibu_Murid }}"
                                                    name="Nama_Ibu_Murid">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Wali_Murid" class="form-label">Nama Wali Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Wali_Murid" value="{{ $murid_madrasah_data->Nama_Wali_Murid }}"
                                                    name="Nama_Wali_Murid">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Murid" class="form-label">Kontak Murid</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Kontak_Murid" value="{{ $murid_madrasah_data->Kontak_Murid }}"
                                                    name="Kontak_Murid">
                                                <div name="" class="form-text">Nomor Orang tua/wali murid</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Alamat_Murid" class="form-label">Alamat Murid</label>
                                                <textarea class="form-control" name="Alamat_Murid" id="Alamat_Murid">{{ $murid_madrasah_data->Alamat_Murid }}</textarea>
                                            </div>

                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Murid" class="form-label">Foto Murid</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Murid"
                                                        name="Foto_Murid">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Murid</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Murid" class="mt-3">
                                                    @if ($murid_madrasah_data->Foto_Murid)
                                                        <img id="Muat_Foto_Murid"
                                                            src="{{ asset('Data_Murid/Foto_Murid/' . $murid_madrasah_data->Foto_Murid) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Foto_Murid" name=""
                                                            class="form-text">(Data
                                                            Foto Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Foto_Murid" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
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
                                                                $('#Muat_Foto_Murid').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_Murid').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}


                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Akta_Kelahiran_Murid" class="form-label">Foto
                                                    Akta Kelahiran Murid</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="Foto_Akta_Kelahiran_Murid" name="Foto_Akta_Kelahiran_Murid">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Akta Kelahiran Murid</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Akta_Kelahiran_Murid" class="mt-3">
                                                    @if ($murid_madrasah_data->Foto_Akta_Kelahiran_Murid)
                                                        <img id="Muat_Foto_Akta_Kelahiran_Murid"
                                                            src="{{ asset('Data_Murid/Foto_Akta_Kelahiran_Murid/' . $murid_madrasah_data->Foto_Akta_Kelahiran_Murid) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Foto_Akta_Kelahiran_Murid" name=""
                                                            class="form-text">(Data
                                                            Foto Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Foto_Akta_Kelahiran_Murid" src="#"
                                                            alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
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
                                                                $('#Muat_Foto_Akta_Kelahiran_Murid').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_Akta_Kelahiran_Murid').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}


                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_KK_Murid" class="form-label">Foto
                                                    Akta Kelahiran Murid</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_KK_Murid"
                                                        name="Foto_KK_Murid">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Akta Kelahiran Murid</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_KK_Murid" class="mt-3">
                                                    @if ($murid_madrasah_data->Foto_KK_Murid)
                                                        <img id="Muat_Foto_KK_Murid"
                                                            src="{{ asset('Data_Murid/Foto_KK_Murid/' . $murid_madrasah_data->Foto_KK_Murid) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Foto_KK_Murid" name=""
                                                            class="form-text">(Data
                                                            Foto Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Foto_KK_Murid" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
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
                                                                $('#Muat_Foto_KK_Murid').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_KK_Murid').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}


                                            <div class="form-group mb-3">
                                                <label for="exampleSelectRounded0">Tingkat Murid</label>
                                                <select class="custom-select rounded-0" id="Tingkat_Murid"
                                                    name="Tingkat_Murid">
                                                    <option selected disabled value>
                                                        {{ $murid_madrasah_data->Tingkat_Murid }}
                                                    </option>
                                                    <option value="1_Satu">1 Satu</option>
                                                    <option value="2_Dua">2 Dua</option>
                                                    <option value="3_Tiga">3 Tiga</option>
                                                    <option value="4_Empat">4 Empat</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Murid" class="form-label">Keterangan
                                                    Murid</label>
                                                <textarea class="form-control" name="Keterangan_Murid">{{ $murid_madrasah_data->Keterangan_Murid }}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="exampleSelectRounded0">Status Murid</label>
                                                <select class="custom-select rounded-0" id="Status_Murid"
                                                    name="Status_Murid">
                                                    <option selected disabled value>
                                                        {{ $murid_madrasah_data->Status_Murid }}</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak_Aktif">Tidak_Aktif</option>
                                                    {{-- <option value="Pindah">Pindah</option> --}}
                                                    <option value="Lainya">Lainya</option>
                                                </select>
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
