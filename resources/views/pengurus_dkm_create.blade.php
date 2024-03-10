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

    <title>Tambah Data Pengurus DKM</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Data Pengurus DKM</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/pengurus_dkm_data">Data Pengurus DKM</a></li>
                            <li class="breadcrumb-item active">Tambah Data Pengurus DKM</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/pengurus_dkm_insert" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Tambah Data Pengurus DKM</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Pengurus</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="PRDKM-<?php echo $tgl; ?>" id="Kode_Pengurus_DKM"
                                                    name="Kode_Pengurus_DKM" readonly>
                                                <div name="" class="form-text">Otomatis Terisi</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="NIP_Pengurus_DKM" class="form-label">NIP Pengurus</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="NIP_Pengurus_DKM" name="NIP_Pengurus_DKM"
                                                    value="{{ old('NIP_Pengurus_DKM') }}">
                                                <div name="" class="form-text">Jika tidak ada NIP boleh dikosongkan
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Jabatan Pengurus</label>
                                                <select class="custom-select rounded-0" id="Jabatan_Pengurus_DKM"
                                                    name="Jabatan_Pengurus_DKM">
                                                    <option selected disabled value>--Pilih--</option>
                                                    {{-- memanggil variable $Bidang_Pengurus_Options yang ada di ruangan controller
                                                    mendefinisikan sebagai variable $Kode_Bidang_Pengurus_DKM
                                                    yang akan di tampilkan sebagai {{ $Nama_Bidang_Pengurus_DKM }} di table gedung --}}
                                                    {{-- Sort the $Bidang_Pengurus_Options array by the values (Jabatan Pengurus) in ascending order --}}
                                                    @php
                                                        $Sorted_Bidang_Pengurus_Options = collect(
                                                            $Bidang_Pengurus_Options,
                                                        )
                                                            ->sort()
                                                            ->all();
                                                    @endphp
                                                    {{-- Loop through the sorted array --}}
                                                    @foreach ($Sorted_Bidang_Pengurus_Options as $Kode_Bidang_Pengurus_DKM => $Nama_Bidang_Pengurus_DKM)
                                                        <option value="{{ $Kode_Bidang_Pengurus_DKM }}"
                                                            {{ old('Jabatan_Pengurus_DKM') == $Kode_Bidang_Pengurus_DKM ? 'selected' : '' }}>
                                                            {{ $Nama_Bidang_Pengurus_DKM }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Jabatan_Pengurus_DKM')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror

                                                <div name="" class="form-text">
                                                    Pilih data yang sesuai, Jika tidak ada isi data ini <a
                                                        href="/bidang_pengurus_dkm_create">Bidang Pengurus DKM</a>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Pengurus_DKM" class="form-label">Nama Pengurus</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Pengurus_DKM" name="Nama_Pengurus_DKM"
                                                    value="{{ old('Nama_Pengurus_DKM') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Pengurus_DKM')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Pengurus_DKM" class="form-label">Kontak Pengurus</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Kontak_Pengurus_DKM" name="Kontak_Pengurus_DKM"
                                                    value="{{ old('Kontak_Pengurus_DKM') }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Kontak_Pengurus_DKM')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Alamat_Pengurus_DKM" class="form-label">Alamat Pengurus</label>
                                                <textarea class="form-control" name="Alamat_Pengurus_DKM" id="Alamat_Pengurus_DKM">{{ old('Alamat_Pengurus_DKM') }}</textarea>
                                                {{-- pemberitahuan validator --}}
                                                @error('Alamat_Pengurus_DKM')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Pengurus_DKM" class="form-label">Foto Pengurus</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Pengurus_DKM"
                                                        name="Foto_Pengurus_DKM">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Pengurus</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Pengurus_DKM" class="mt-3">
                                                    <img id="Muat_Foto_Pengurus_DKM" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_Pengurus_DKM').on('change', function() {
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
                                                            $('#Muat_Foto_Pengurus_DKM').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Pengurus_DKM').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}


                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Identitas_Pengurus_DKM" class="form-label">Foto Identitas
                                                    (KTP/SIM)
                                                </label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="Identitas_Pengurus_DKM" name="Identitas_Pengurus_DKM">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Identitas</label>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Identitas_Pengurus_DKM" class="mt-3">
                                                    <img id="Muat_Identitas_Pengurus_DKM" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Identitas_Pengurus_DKM').on('change', function() {
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
                                                            $('#Muat_Identitas_Pengurus_DKM').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Identitas_Pengurus_DKM').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Pengurus_DKM" class="form-label">Keterangan
                                                    Pengurus</label>
                                                <textarea class="form-control" name="Keterangan_Pengurus_DKM" id="Keterangan_Pengurus_DKM">{{ old('Keterangan_Pengurus_DKM') }}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Status_Pengurus_DKM">Status Pengurus</label>
                                                <select class="custom-select rounded-0" id="Status_Pengurus_DKM"
                                                    name="Status_Pengurus_DKM">
                                                    <option selected disabled value>--Pilih--</option>
                                                    <option value="Aktif"
                                                        {{ old('Status_Pengurus_DKM') == 'Aktif' ? 'selected' : '' }}>Aktif
                                                    </option>
                                                    <option value="Tidak_Aktif"
                                                        {{ old('Status_Pengurus_DKM') == 'Tidak_Aktif' ? 'selected' : '' }}>
                                                        Tidak Aktif</option>
                                                    <option value="Lainya"
                                                        {{ old('Status_Pengurus_DKM') == 'Lainya' ? 'selected' : '' }}>
                                                        Lainya
                                                    </option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Pengurus_DKM')
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
