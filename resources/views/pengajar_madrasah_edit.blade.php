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
                        <h1 class="m-0">Edit Data Pengajar Madrasah</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/pengajar_madrasah_data">Data Pengajar Madrasah</a></li>
                            <li class="breadcrumb-item active">Edit Data Pengajar Madrasah</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/pengajar_madrasah_update/{{ $pengajar_madrasah_data->id_pengajar }}" method="POST"
                        enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Data Pengajar Madrasah</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="Kode_Pengajar" class="form-label">Kode Pengajar</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="{{ $pengajar_madrasah_data->Kode_Pengajar }}" id="Kode_Pengajar"
                                                    name="Kode_Pengajar" readonly>
                                                <div name="" class="form-text">Tidak Bisa Diubah</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Pengajar" class="form-label">Nama Pengajar</label>
                                                <input type="text" class="form-control" placeholder="" id="Nama_Pengajar"
                                                    value="{{ $pengajar_madrasah_data->Nama_Pengajar }}"
                                                    name="Nama_Pengajar">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Pengajar" class="form-label">Kontak Pengajar</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Kontak_Pengajar"
                                                    value="{{ $pengajar_madrasah_data->Kontak_Pengajar }}"
                                                    name="Kontak_Pengajar">
                                                <div name="" class="form-text">Nomor Orang tua/wali Pengajar</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Alamat_Pengajar" class="form-label">Alamat Pengajar</label>
                                                <textarea class="form-control" name="Alamat_Pengajar" id="Alamat_Pengajar">{{ $pengajar_madrasah_data->Alamat_Pengajar }}</textarea>
                                            </div>

                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Pengajar" class="form-label">Foto Pengajar</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Pengajar"
                                                        name="Foto_Pengajar">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Pengajar</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Pengajar" class="mt-3">
                                                    @if ($pengajar_madrasah_data->Foto_Pengajar)
                                                        <img id="Muat_Foto_Pengajar"
                                                            src="{{ asset('Data_Pengajar/Foto_Pengajar/' . $pengajar_madrasah_data->Foto_Pengajar) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Foto_Pengajar" name=""
                                                            class="form-text">(Data
                                                            Foto Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Foto_Pengajar" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
                                                    $('#Foto_Pengajar').on('change', function() {
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
                                                                $('#Muat_Foto_Pengajar').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_Pengajar').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}


                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Identitas_Pengajar" class="form-label">Identitas
                                                    Pengajar</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Identitas_Pengajar"
                                                        name="Identitas_Pengajar">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Identitas
                                                        Pengajar</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Identitas
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Identitas_Pengajar" class="mt-3">
                                                    @if ($pengajar_madrasah_data->Identitas_Pengajar)
                                                        <img id="Muat_Identitas_Pengajar"
                                                            src="{{ asset('Data_Pengajar/Identitas_Pengajar/' . $pengajar_madrasah_data->Identitas_Pengajar) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Identitas_Pengajar" name=""
                                                            class="form-text">(Data
                                                            Identitas Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Identitas_Pengajar" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
                                                    $('#Identitas_Pengajar').on('change', function() {
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
                                                                $('#Muat_Identitas_Pengajar').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Identitas_Pengajar').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Pengajar" class="form-label">Keterangan
                                                    Pengajar</label>
                                                <textarea class="form-control" name="Keterangan_Pengajar">{{ $pengajar_madrasah_data->Keterangan_Pengajar }}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="exampleSelectRounded0">Status Pengajar</label>
                                                <select class="custom-select rounded-0" id="Status_Pengajar"
                                                    name="Status_Pengajar">
                                                    <option selected disabled value>
                                                        {{ $pengajar_madrasah_data->Status_Pengajar }}</option>
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
                                                <a href="/pengajar_madrasah_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
