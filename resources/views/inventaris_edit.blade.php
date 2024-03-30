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

    <title>Edit Data Inventaris</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Inventaris</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/inventaris_data">Data Inventaris</a></li>
                            <li class="breadcrumb-item active">Edit Data Inventaris</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/inventaris_update/{{ $inventaris_data->id_inventaris }}" method="POST"
                        enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Data Inventaris</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="Kode_Inventaris" class="form-label">Kode Inventaris</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="{{ $inventaris_data->Kode_Inventaris }}" id="Kode_Inventaris"
                                                    name="Kode_Inventaris" readonly>
                                                <div name="" class="form-text">Tidak Bisa Diubah</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Inventaris" class="form-label">Nama Inventaris</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Inventaris" name="Nama_Inventaris"
                                                    value="{{ $inventaris_data->Nama_Inventaris }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Merk_Inventaris" class="form-label">Merk Inventaris</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Merk_Inventaris" name="Merk_Inventaris"
                                                    value="{{ $inventaris_data->Merk_Inventaris }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Jenis_Inventaris">Jenis_Inventaris</label>
                                                <select class="custom-select rounded-0" id="Jenis_Inventaris"
                                                    name="Jenis_Inventaris">
                                                    <option selected disabled value>{{ $inventaris_data->Jenis_Inventaris }}
                                                    </option>
                                                    <option value="Elektronik">
                                                        Elektronik
                                                    </option>
                                                    <option value="Kendaraan">
                                                        Kendaraan</option>
                                                    <option value="Peralatan_Kebersihan">
                                                        Peralatan Kebersihan
                                                    </option>
                                                    <option value="Furniture_Perabotan">
                                                        Furniture Perabotan
                                                    </option>
                                                    <option value="Peralatan_Ibadah">
                                                        Peralatan Ibadah
                                                    </option>
                                                    <option value="Peralatan_Bangunan">
                                                        Peralatan Bangunan
                                                    </option>
                                                    <option value="Lainya">Lainya
                                                    </option>
                                                </select>
                                            </div>


                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Inventaris" class="form-label">Foto Inventaris</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Inventaris"
                                                        name="Foto_Inventaris">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Inventaris</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Inventaris" class="mt-3">
                                                    @if ($inventaris_data->Foto_Inventaris)
                                                        <img id="Muat_Foto_Inventaris"
                                                            src="{{ asset('Data_Inventaris/Foto_Inventaris/' . $inventaris_data->Foto_Inventaris) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Foto_Inventaris" name=""
                                                            class="form-text">(Data
                                                            Foto Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Foto_Inventaris" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
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
                                                                $('#Muat_Foto_Inventaris').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_Inventaris').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}


                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Faktur_Inventaris" class="form-label">Faktur Inventaris</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Faktur_Inventaris"
                                                        name="Faktur_Inventaris">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Faktur
                                                        Inventaris</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto
                                                        Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Faktur_Inventaris" class="mt-3">
                                                    @if ($inventaris_data->Faktur_Inventaris)
                                                        <img id="Muat_Faktur_Inventaris"
                                                            src="{{ asset('Data_Inventaris/Faktur_Inventaris/' . $inventaris_data->Faktur_Inventaris) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Faktur_Inventaris" name=""
                                                            class="form-text">(Data
                                                            Faktur Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Faktur_Inventaris" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
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
                                                                $('#Muat_Faktur_Inventaris').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Faktur_Inventaris').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Operasional_Inventaris" class="form-label">Tanggal
                                                    Operasional Inventaris</label>
                                                <input class="form-control" type="date"
                                                    id="Tanggal_Operasional_Inventaris"
                                                    name="Tanggal_Operasional_Inventaris"
                                                    value="{{ $inventaris_data->Tanggal_Operasional_Inventaris }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Inventaris" class="form-label">Keterangan
                                                    Inventaris</label>
                                                <textarea class="form-control" name="Keterangan_Inventaris" id="Keterangan_Inventaris">{{ $inventaris_data->Keterangan_Inventaris }}</textarea>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Status_Inventaris">Status Inventaris</label>
                                                <select class="custom-select rounded-0" id="Status_Inventaris"
                                                    name="Status_Inventaris">
                                                    <option selected disabled value>
                                                        {{ $inventaris_data->Status_Inventaris }}
                                                    </option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak_Aktif">Tidak_Aktif</option>
                                                    <option value="Lainya">Lainya</option>
                                                </select>
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
