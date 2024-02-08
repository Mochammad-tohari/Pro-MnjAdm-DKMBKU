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

    <title>Edit Data Uji</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Data Uji</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/data_uji">Data Uji</a></li>
                            <li class="breadcrumb-item active">Edit Data Uji</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/update_data_uji/{{ $data_uji->id }}" method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Data Uji</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="kode" class="form-label">Kode</label>
                                                <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                                <?php
                                                $tgl = date('ymdGis');
                                                ?>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="{{ $data_uji->Kode }}" id="" name="Kode" readonly>
                                                <div name="" class="form-text">Tidak Bisa Diubah</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" placeholder="" id=""
                                                    name="Nama" value="{{ $data_uji->Nama }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Password" class="form-label">Password</label>
                                                <input type="password" class="form-control" placeholder="" id=""
                                                    name="Password" value="{{ $data_uji->Password }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                                <input class="form-control" type="date" id=""
                                                    name="Tanggal_masuk" value="{{ $data_uji->Tanggal_masuk }}" />
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="exampleSelectRounded0">Status</label>
                                                <select class="custom-select rounded-0" id="exampleSelectRounded0"
                                                    name="Status">
                                                    <option selected disabled value>{{ $data_uji->Status }}</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak_Aktif">Tidak_Aktif</option>
                                                </select>
                                            </div>

                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto1" class="form-label">Foto Uji 1</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto1"
                                                        name="Foto1" value="{{ $data_uji->Foto1 }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        1</label>
                                                </div>
                                                <label for="Foto1" class="form-label">Kosongkan jika tidak ada foto
                                                    baru</label>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto1" class="mt-3">
                                                    <img id="muat_foto1" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>
                                            <script>
                                                $('#Foto1').on('change', function() {
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
                                                            $('#muat_foto1').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto1').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}

                                            {{-- syntax edit gambar --}}
                                            <div class="form-group mb-3">
                                                <label for="Foto2" class="form-label">Foto Uji 2</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="Foto2"
                                                        name="Foto2" value="{{ $data_uji->Foto2 }}">
                                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto
                                                        2</label>
                                                </div>
                                                <label for="Foto2" class="form-label">Kosongkan jika tidak ada foto
                                                    baru</label>
                                                <!-- Image preview -->
                                                <div id="Preview_Foto2" class="mt-3">
                                                    <img id="muat_foto2" src="#" alt=""
                                                        style="max-width: 150px; max-height: 150px;">
                                                </div>
                                            </div>
                                            <script>
                                                $('#Foto2').on('change', function() {
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
                                                            $('#muat_foto2').attr('src', e.target.result);
                                                        }
                                                        reader.readAsDataURL(this.files[0]);
                                                        $('#Preview_Foto2').show(); // Show the image preview container
                                                    }
                                                });
                                            </script>
                                            {{-- akhir syntax edit gambar --}}

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/data_uji" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
