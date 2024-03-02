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

    <title>Edit Data Uji User</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Uji User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/pengurus_dkm_data">Data Uji User</a></li>
                            <li class="breadcrumb-item active">Edit Data Uji User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/uji_user_update/{{ $uji_user_data->id_uji_user }}" method="POST"
                        enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Data Uji User</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Uji User</label>
                                                <input type="text" class="form-control" placeholder="" id=""
                                                    name="Kode_Uji_User" value="{{ $uji_user_data->Kode_Uji_User }}"
                                                    readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Jabatan Uji User</label>
                                                <select class="custom-select rounded-0" id="Jabatan Uji User"
                                                    name="Jabatan Uji User">
                                                    <option selected disabled value>--Pilih--</option>
                                                    {{-- memanggil variable $Uji_Bidang_Options yang ada di ruangan controller
                                                        mendefinisikan sebagai variable $Kode_Bidang
                                                        yang akan di tampilkan sebagai {{ $Nama_Bidang }} di table uji_bidang --}}
                                                    {{-- Sort the $Uji_Bidang_Options array by the values (nama uji_bidang) in ascending order --}}
                                                    @php
                                                        $Sorted_Uji_Bidang_Options = collect($Uji_Bidang_Options)
                                                            ->sort()
                                                            ->all();
                                                    @endphp

                                                    @foreach ($Sorted_Uji_Bidang_Options as $Jabatan_Uji_User => $Nama_Bidang)
                                                        <option value="{{ $Jabatan_Uji_User }}"
                                                            {{ $uji_user_data->Jabatan_Uji_User == $Jabatan_Uji_User ? 'selected' : '' }}>
                                                            {{ $Nama_Bidang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div name="" class="form-text">Pilih data yang sesuai, Jika tidak
                                                    ada
                                                    isi data ini <a href="/uji_bidang_create">Uji Bidang Pengurus</a>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Uji_User" class="form-label">Nama Uji User</label>
                                                <input type="text" class="form-control" placeholder="" id="Nama_Uji_User"
                                                    name="Nama_Uji_User" value="{{ $uji_user_data->Nama_Uji_User }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Password_Uji_User" class="form-label">Password Uji User</label>
                                                <input type="password" class="form-control" placeholder=""
                                                    id="Password_Uji_User" name="Password_Uji_User"
                                                    value="{{ $uji_user_data->Password_Uji_User }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Password_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Uji_User" class="form-label">Tanggal Uji User</label>
                                                <input type="date" class="form-control" placeholder=""
                                                    id="Tanggal_Uji_User" name="Tanggal_Uji_User"
                                                    value="{{ $uji_user_data->Tanggal_Uji_User }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Tanggal_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Uji_User" class="form-label">Keterangan Uji
                                                    User</label>
                                                <textarea class="form-control" name="Keterangan_Uji_User" id="Keterangan_Uji_User">{{ $uji_user_data->Keterangan_Uji_User }}</textarea>
                                                {{-- pemberitahuan validator --}}
                                                @error('Keterangan_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Profil" class="form-label">Foto Profil</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Profil"
                                                        name="Foto_Profil">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Profil</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Profil" class="mt-3">
                                                    @if ($uji_user_data->Foto_Profil)
                                                        <img id="Muat_Foto_Profil"
                                                            src="{{ asset('Data_Uji_User/Foto_Profil/' . $uji_user_data->Foto_Profil) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                    @else
                                                        <img id="Muat_Foto_Profil" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
                                                    $('#Foto_Profil').on('change', function() {
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
                                                                $('#Muat_Foto_Profil').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_Profil').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}



                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Identitas" class="form-label">Foto Identitas</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Identitas"
                                                        name="Foto_Identitas">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Identitas</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Identitas" class="mt-3">
                                                    @if ($uji_user_data->Foto_Identitas)
                                                        <img id="Muat_Foto_Identitas"
                                                            src="{{ asset('Data_Uji_User/Foto_Identitas/' . $uji_user_data->Foto_Identitas) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                    @else
                                                        <img id="Muat_Foto_Identitas" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
                                                    $('#Foto_Identitas').on('change', function() {
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
                                                                $('#Muat_Foto_Identitas').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_Identitas').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Status_Uji_User">Status Uji User</label>
                                                <select class="custom-select rounded-0" id="Status_Uji_User"
                                                    name="Status_Uji_User">
                                                    <option selected disabled value>
                                                        {{ $uji_user_data->Status_Uji_User }}</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak_Aktif">Tidak_Aktif</option>
                                                    <option value="Lainya">Lainya</option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/uji_user_data_new" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
