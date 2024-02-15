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

    <title>Edit Data Pengurus DKM</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Pengurus DKM</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/pengurus_dkm_data">Data Pengurus DKM</a></li>
                            <li class="breadcrumb-item active">Edit Data Pengurus DKM</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/pengurus_dkm_update/{{ $pengurus_dkm_data->id_pengurus }}" method="POST"
                        enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Data Pengurus DKM</h3>
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
                                                    value="{{ $pengurus_dkm_data->Kode_Pengurus }}" id=""
                                                    name="Kode_Pengurus" readonly>
                                                <div name="" class="form-text">Tidak Bisa Diubah</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="NIP_Pengurus" class="form-label">NIP Pengurus</label>
                                                <input type="text" class="form-control" placeholder="" id=""
                                                    name="NIP_Pengurus" value="{{ $pengurus_dkm_data->NIP_Pengurus }}">
                                                <div name="" class="form-text">Jika tidak ada NIP boleh dikosongkan
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Jabatan Pengurus</label>
                                                <select class="custom-select rounded-0" id=""
                                                    name="Jabatan_Pengurus">
                                                    <option selected disabled value>--Pilih--</option>
                                                    {{-- memanggil variable $Bidang_Pengurus_Options yang ada di ruangan controller
                                                    mendefinisikan sebagai variable $Kode_Bidang_Pengurus
                                                    yang akan di tampilkan sebagai {{ $Nama_Bidang_Pengurus }} di table Bidang_Pengurus --}}
                                                    {{-- Sort the $Bidang_Pengurus_Options array by the values (nama Bidang_Pengurus) in ascending order --}}
                                                    @php
                                                        $Sorted_Bidang_Pengurus_Options = collect($Bidang_Pengurus_Options)->sort()->all();
                                                    @endphp

                                                    @foreach ($Sorted_Bidang_Pengurus_Options as $Jabatan_Pengurus => $Nama_Bidang_Pengurus)
                                                        <option value="{{ $Jabatan_Pengurus }}"
                                                            {{ $pengurus_dkm_data->Jabatan_Pengurus == $Jabatan_Pengurus ? 'selected' : '' }}>
                                                            {{ $Nama_Bidang_Pengurus }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div name="" class="form-text">Pilih data yang sesuai, Jika tidak ada
                                                    isi data ini <a href="/bidang_pengurus_create">Bidang Khodim</a></div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Pengurus" class="form-label">Nama Pengurus</label>
                                                <input type="text" class="form-control" placeholder="" id=""
                                                    name="Nama_Pengurus" value="{{ $pengurus_dkm_data->Nama_Pengurus }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Pengurus')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Kontak_Pengurus" class="form-label">Kontak Pengurus</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Kontak_Pengurus" name="Kontak_Pengurus"
                                                    value="{{ $pengurus_dkm_data->Kontak_Pengurus }}">
                                                {{-- pemberitahuan validator --}}
                                                @error('Nama_Pengurus')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Alamat_Pengurus" class="form-label">Alamat Pengurus</label>
                                                <textarea class="form-control" name="Alamat_Pengurus" id="Alamat_Pengurus">{{ $pengurus_dkm_data->Alamat_Pengurus }}</textarea>
                                                {{-- pemberitahuan validator --}}
                                                @error('Alamat_Pengurus')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Pengurus" class="form-label">Foto Pengurus</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Pengurus"
                                                        name="Foto_Pengurus"
                                                        value="{{ $pengurus_dkm_data->Foto_Pengurus }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Pengurus</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Pengurus" class="mt-3">
                                                    <img id="Muat_Foto_Pengurus" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Foto_Pengurus').on('change', function() {
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
                                                            $('#Muat_Foto_Pengurus').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto_Pengurus').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}


                                            {{-- syntax input gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Identitas_Pengurus" class="form-label">Foto Identitas
                                                    (KTP/SIM)
                                                </label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="Identitas_Pengurus" name="Identitas_Pengurus"
                                                        value="{{ $pengurus_dkm_data->Identitas_Pengurus }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Pengurus</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru</div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Identitas_Pengurus" class="mt-3">
                                                    <img id="Muat_Identitas_Pengurus" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>

                                            <script>
                                                $('#Identitas_Pengurus').on('change', function() {
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
                                                            $('#Muat_Identitas_Pengurus').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Identitas_Pengurus').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax input gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Pengurus" class="form-label">Keterangan
                                                    Pengurus</label>
                                                <textarea class="form-control" name="Keterangan_Pengurus" id="Keterangan_Pengurus">{{ $pengurus_dkm_data->Keterangan_Pengurus }}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Status_Pengurus">Status Pengurus</label>
                                                <select class="custom-select rounded-0" id="Status_Pengurus"
                                                    name="Status_Pengurus">
                                                    <option selected disabled value>
                                                        {{ $pengurus_dkm_data->Status_Pengurus }}</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak_Aktif">Tidak_Aktif</option>
                                                    <option value="Lainya">Lainya</option>
                                                </select>
                                                {{-- pemberitahuan validator --}}
                                                @error('Status_Pengurus')
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
