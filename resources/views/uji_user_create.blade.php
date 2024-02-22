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

    <title>Tambah Data Uji User</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Uji User</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/pengurus_dkm_data">Data Uji User</a></li>
                            <li class="breadcrumb-item active">Tambah Data Uji User</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/uji_user_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Uji User</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Uji User</label>
                                                <!-- tag php dan echo ?php disini utk membuat Kode key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="UJUSR-<?php echo $tgl; ?>" id="" name="Kode_Uji_User"
                                                    readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Jabatan Uji User</label>
                                                <select class="custom-select rounded-0" id="Jabatan_Uji_User"
                                                    name="Jabatan_Uji_User">
                                                    <option selected disabled value>--Pilih--</option>
                                                    {{-- memanggil variable $Uji_User_Options yang ada di ruangan controller
                                                    mendefinisikan sebagai variable $Kode_Bidang
                                                    yang akan di tampilkan sebagai {{ $Nama_Bidang }} di table uji_bidang --}}
                                                    {{-- Sort the $Uji_User_Options array by the values (Jabatan Pengurus) in ascending order --}}
                                                    @php
                                                        $Sorted_Uji_User_Options = collect($Uji_User_Options)->sort()->all();
                                                    @endphp
                                                    {{-- Loop through the sorted array --}}
                                                    @foreach ($Sorted_Uji_User_Options as $Kode_Bidang => $Nama_Bidang)
                                                        <option value="{{ $Kode_Bidang }}">
                                                            {{ $Nama_Bidang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Jabatan_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <div name="" class="form-text">
                                                    Pilih data yang sesuai, Jika tidak ada isi data ini <a
                                                        href="/uji_bidang_create">Uji Bidang</a>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Uji_User" class="form-label">Nama Uji User</label>
                                                <input type="text" class="form-control" placeholder="" id=""
                                                    name="Nama_Uji_User" value="{{ old('Nama_Uji_User') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Password_Uji_User" class="form-label">Password Uji User</label>
                                                <input type="password" class="form-control" placeholder=""
                                                    id="Password_Uji_User" name="Password_Uji_User"
                                                    value="{{ old('Password_Uji_User') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Password_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Uji_User" class="form-label">Tanggal Uji User</label>
                                                <input type="date" class="form-control" placeholder=""
                                                    id="Tanggal_Uji_User" name="Tanggal_Uji_User">
                                                {{-- pemberitahuan validator --}}
                                                @error('Tanggal_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Uji_User" class="form-label">Keterangan Uji
                                                    User</label>
                                                <textarea class="form-control" name="Keterangan_Uji_User" id="Keterangan_Uji_User">{{ old('Keterangan_Uji_User') }}</textarea>
                                                {{-- pemberitahuan validator --}}
                                                @error('Keterangan_Uji_User')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Profil" class="form-label">Foto Profil</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Profil"
                                                        name="Foto_Profil">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Profil</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Profil" class="mt-3">
                                                    <img id="Muat_Foto_Profil" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
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
                                                            $('#Muat_Foto_Profil').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Profil').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}


                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Identitas" class="form-label">Foto Identitas (KTP/SIM)
                                                </label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Identitas"
                                                        name="Foto_Identitas">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Identitas</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Identitas" class="mt-3">
                                                    <img id="Muat_Foto_Identitas" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
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
                                                            $('#Muat_Foto_Identitas').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Identitas').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Status_Uji_User">Status Uji User</label>
                                                <select class="custom-select rounded-0" id="Status_Uji_User"
                                                    name="Status_Uji_User">
                                                    <option selected disabled value>--Pilih--</option>
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
                                                <a href="/uji_user_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
