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

    <title>Tambah Data Pengurus Nawa</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Pengurus Nawa</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/pengurus_nawa_data">Data Pengurus Nawa</a></li>
                            <li class="breadcrumb-item active">Tambah Data Pengurus Nawa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/pengurus_nawa_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Pengurus Nawa</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Pengurus Nawa</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="PRSNW-<?php echo $tgl; ?>" id="Kode_Pengurus_Nawa"
                                                    name="Kode_Pengurus_Nawa" readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="NIP_Pengurus_Nawa" class="form-label">NIP Pengurus Nawa</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="NIP_Pengurus_Nawa" name="NIP_Pengurus_Nawa"
                                                    value="{{ old('NIP_Pengurus_Nawa') }}">
                                                <div name="" class="form-text">Jika tidak ada NIP boleh dikosongkan
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Jabatan Pengurus Nawa</label>
                                                <select class="custom-select rounded-0" id="Jabatan_Pengurus_Nawa"
                                                    name="Jabatan_Pengurus_Nawa">
                                                    <option selected disabled value>--Pilih--</option>
                                                    {{-- memanggil variable $Bidang_Pengurus_Options yang ada di ruangan controller
                                                    mendefinisikan sebagai variable $Kode_Bidang_Pengurus_Nawa
                                                    yang akan di tampilkan sebagai {{ $Nama_Bidang_Pengurus_Nawa }} di table gedung --}}
                                                    {{-- Sort the $Bidang_Nawa_Options array by the values (Jabatan Pengurus) in ascending order --}}
                                                    @php
                                                        $Sorted_Bidang_Nawa_Options = collect($Bidang_Nawa_Options)
                                                            ->sort()
                                                            ->all();
                                                    @endphp
                                                    {{-- Loop through the sorted array --}}
                                                    @foreach ($Sorted_Bidang_Nawa_Options as $Kode_Bidang_Nawa => $Nama_Bidang_Nawa)
                                                        <option value="{{ $Kode_Bidang_Nawa }}"
                                                            {{ old('Jabatan_Pengurus_Nawa') == $Kode_Bidang_Nawa ? 'selected' : '' }}>
                                                            {{ $Nama_Bidang_Nawa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Jabatan_Pengurus_Nawa')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <div name="" class="form-text">
                                                    Pilih data yang sesuai, Jika tidak ada isi data ini <a
                                                        href="/bidang_nawa_create">Bidang Nawa</a>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Pengurus_Nawa" class="form-label">Nama Pengurus
                                                    Nawa</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Pengurus_Nawa" name="Nama_Pengurus_Nawa"
                                                    value="{{ old('Nama_Pengurus_Nawa') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Pengurus_Nawa')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Pengurus_Nawa" class="form-label">Kontak Pengurus
                                                    Nawa</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Kontak_Pengurus_Nawa" name="Kontak_Pengurus_Nawa"
                                                    value="{{ old('Kontak_Pengurus_Nawa') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Kontak_Pengurus_Nawa')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Alamat_Pengurus_Nawa" class="form-label">Alamat Pengurus
                                                    Nawa</label>
                                                <textarea class="form-control" name="Alamat_Pengurus_Nawa" id="Alamat_Pengurus_Nawa">{{ old('Alamat_Pengurus_Nawa') }}</textarea>
                                                {{-- pemberitahuan validator --}}
                                                @error('Alamat_Pengurus_Nawa')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Pengurus_Nawa" class="form-label">Foto Pengurus
                                                    Nawa</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Pengurus_Nawa"
                                                        name="Foto_Pengurus_Nawa">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Pengurus</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Pengurus_Nawa" class="mt-3">
                                                    <img id="Muat_Foto_Pengurus_Nawa" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_Pengurus_Nawa').on('change', function() {
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
                                                            $('#Muat_Foto_Pengurus_Nawa').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Pengurus_Nawa').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}


                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Identitas_Pengurus_Nawa" class="form-label">Foto Identitas
                                                    Pengurus Nawa
                                                    (KTP/SIM)
                                                </label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="Identitas_Pengurus_Nawa" name="Identitas_Pengurus_Nawa">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Identitas</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Identitas_Pengurus_Nawa" class="mt-3">
                                                    <img id="Muat_Identitas_Pengurus_Nawa" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Identitas_Pengurus_Nawa').on('change', function() {
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
                                                            $('#Muat_Identitas_Pengurus_Nawa').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Identitas_Pengurus_Nawa').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Pengurus_Nawa" class="form-label">Keterangan
                                                    Pengurus Nawa</label>
                                                <textarea class="form-control" name="Keterangan_Pengurus_Nawa" id="Keterangan_Pengurus_Nawa">{{ old('Keterangan_Pengurus_Nawa') }}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Status_Pengurus_Nawa">Status Pengurus Nawa</label>
                                                <select class="custom-select rounded-0" id="Status_Pengurus_Nawa"
                                                    name="Status_Pengurus_Nawa">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif"
                                                        {{ old('Status_Pengurus_Nawa') == 'Aktif' ? 'selected' : '' }}>
                                                        Aktif
                                                    </option>
                                                    <option value="Tidak_Aktif"
                                                        {{ old('Status_Pengurus_Nawa') == 'Tidak_Aktif' ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                    <option value="Lainya"
                                                        {{ old('Status_Pengurus_Nawa') == 'Lainya' ? 'selected' : '' }}>
                                                        Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Pengurus_Nawa')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/pengurus_dkm_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
