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

    <title>Edit Bidang Pengurus DKM</title>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Bidang Pengurus DKM</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/gedung_data">Bidang Pengurus DKM</a></li>
                            <li class="breadcrumb-item active">Edit Bidang Pengurus DKM</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div>

            <!-- /.card-header -->
            <div class="card-body col-auto">
                <div class="card-body">
                    <form action="/bidang_pengurus_dkm_update/{{ $bidang_pengurus_dkm_data->id_bidang_pengurus_dkm }}"
                        method="POST" enctype="multipart/form-data">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        @csrf
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header mb-3">
                                        <h3 class="card-title">Edit Bidang Pengurus</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body mb-3">

                                            <div class="form-group mb-3">
                                                <label for="id" class="form-label">Kode Bidang Pengurus</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    value="{{ $bidang_pengurus_dkm_data->Kode_Bidang_Pengurus_DKM }}"
                                                    id="Kode_Bidang_Pengurus_DKM" name="Kode_Bidang_Pengurus_DKM" readonly>
                                                <div name="" class="form-text">Tidak Bisa Diubah</div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Nama_Bidang_Pengurus_DKM" class="form-label">Nama Bidang
                                                    Pengurus</label>
                                                <input type="text" class="form-control" placeholder=""
                                                    id="Nama_Bidang_Pengurus_DKM" name="Nama_Bidang_Pengurus_DKM"
                                                    value="{{ $bidang_pengurus_dkm_data->Nama_Bidang_Pengurus_DKM }}">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Keterangan_Bidang_Pengurus_DKM" class="form-label">Keterangan
                                                    Bidang
                                                    Pengurus</label>
                                                <textarea class="form-control" name="Keterangan_Bidang_Pengurus_DKM" id="Keterangan_Bidang_Pengurus_DKM">{{ $bidang_pengurus_dkm_data->Keterangan_Bidang_Pengurus_DKM }}</textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="Status_Bidang_Pengurus_DKM">Status Bidang Pengurus</label>
                                                <select class="custom-select rounded-0" id="Status_Bidang_Pengurus_DKM"
                                                    name="Status_Bidang_Pengurus_DKM">
                                                    <option selected disabled value>
                                                        {{ $bidang_pengurus_dkm_data->Status_Bidang_Pengurus_DKM }}</option>
                                                    <option value="Aktif">Aktif</option>
                                                    <option value="Tidak_Aktif">Tidak_Aktif</option>
                                                    <option value="Lainya">Lainya</option>
                                                </select>
                                            </div>

                                            <!-- /.card-body -->

                                            <div class="card-footer mb-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                                <a href="/bidang_pengurus_dkm_data" class="ml-2">
                                                    <button type="button" class="btn btn-danger">Batal</button>
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->
                    @endsection
