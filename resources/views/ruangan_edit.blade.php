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

    <title>Edit Data Ruangan</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Ruangan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/ruangan_data">Data Ruangan</a></li>
                            <li class="breadcrumb-item active">Edit Data Ruangan</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/ruangan_update/{{ $ruangan_data->id_ruangan }}" method="POST"
                        enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Data Ruangan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Ruangan</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="{{ $ruangan_data->Kode_Ruangan }}" id="Kode_Ruangan"
                                                    name="Kode_Ruangan" readonly>
                                                <div name="" class="form-text">Tidak bisa diubah</div>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Nama Gedung</label>
                                                <select class="custom-select rounded-0" id="Gedung_Kode" name="Gedung_Kode">
                                                    <option selected disabled value>--Pilih--</option>
                                                    {{-- memanggil variable $gedungOptions yang ada di ruangan controller
                                                     mendefinisikan sebagai variable $Kode_Gedung
                                                     yang akan di tampilkan sebagai {{ $Nama_Gedung }} di table gedung --}}
                                                    {{-- Sort the $gedungOptions array by the values (nama gedung) in ascending order --}}
                                                    @php
                                                        $sortedGedungOptions = collect($gedungOptions)->sort()->all();
                                                    @endphp

                                                    {{-- Loop through the sorted array --}}
                                                    @foreach ($sortedGedungOptions as $Gedung_Kode => $Nama_Gedung)
                                                        <option value="{{ $Gedung_Kode }}"
                                                            {{ $ruangan_data->Gedung_Kode == $Gedung_Kode ? 'selected' : '' }}>
                                                            {{ $Nama_Gedung }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                {{-- memanggil variable $gedungOptions yang ada di ruangan controller
                                                 mendefinisikan sebagai variable $Kode_Gedung
                                                 yang akan di tampilkan sebagai {{ $Nama_Gedung }} di table gedung --}}
                                                <div name="" class="form-text">
                                                    Pilih data yang sesuai, Jika tidak ada isi data ini <a
                                                        href="/gedung_create">Gedung</a>
                                                </div>
                                            </div>


                                            <div class="form-group mb-3">
                                                <label for="Nama_Ruangan" class="form-label">Nama Ruangan</label>
                                                <input type="text" class="form-control" placeholder="" id="Nama_Ruangan"
                                                    name="Nama_Ruangan" value="{{ $ruangan_data->Nama_Ruangan }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Luas_Ruangan" class="form-label">Luas Ruangan</label>
                                                <textarea class="form-control" name="Luas_Ruangan" id="Luas_Ruangan"> {{ $ruangan_data->Luas_Ruangan }} </textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_Operasional_Ruangan" class="form-label">Tanggal
                                                    Operasional Ruangan</label>
                                                <input class="form-control" type="date" id="Tanggal_Operasional_Ruangan"
                                                    name="Tanggal_Operasional_Ruangan"
                                                    value="{{ $ruangan_data->Tanggal_Operasional_Ruangan }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Ruangan" class="form-label">Keterangan
                                                    Ruangan</label>
                                                <textarea class="form-control" name="Keterangan_Ruangan" id="Keterangan_Ruangan"> {{ $ruangan_data->Keterangan_Ruangan }} </textarea>
                                            </div>

                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto_Ruangan" class="form-label">Foto Profil</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto_Ruangan"
                                                        name="Foto_Ruangan">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        Ruangan</label>
                                                    <div name="" class="form-text">Kosongkan Jika Tidak Ada Foto Baru
                                                    </div>
                                                </div>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto_Ruangan" class="mt-3">
                                                    @if ($ruangan_data->Foto_Ruangan)
                                                        <img id="Muat_Foto_Ruangan"
                                                            src="{{ asset('Data_Ruangan/Foto_Ruangan/' . $ruangan_data->Foto_Ruangan) }}"
                                                            alt="" style="max-width: 150px; max-height: 150px;">
                                                        <label for="Muat_Foto_Ruangan" name=""
                                                            class="form-text">(Data
                                                            Foto Sebelumnya)</label>
                                                    @else
                                                        <img id="Muat_Foto_Ruangan" src="#" alt=""
                                                            style="max-width: 150px; max-height: 150px; display: none;">
                                                    @endif

                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Check if there's a file selected
                                                    $('#Foto_Ruangan').on('change', function() {
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
                                                                $('#Muat_Foto_Ruangan').attr('src', e.target.result).show();
                                                            }
                                                            reader.readAsDataURL(this.files[0]);
                                                            $('#Preview_Foto_Ruangan').show(); // Show the image preview container
                                                        }
                                                    });
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}

                                            <div class="form-group mb-3">
                                                <label for="Status_Ruangan">Status_Ruangan</label>
                                                <select class="custom-select rounded-0" id="Status_Ruangan"
                                                    name="Status_Ruangan">
                                                    <option selected disabled value>{{ $ruangan_data->Status_Ruangan }}
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
                                                <a href="/ruangan_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
