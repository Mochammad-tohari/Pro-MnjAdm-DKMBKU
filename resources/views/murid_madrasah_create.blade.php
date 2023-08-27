@extends('layout.admin')

@section('content')

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<title>Tambah Data Murid Madrasah</title>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Data Murid Madrasah</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/murid_madrasah_data">Data Murid Madrasah</a></li>
            <li class="breadcrumb-item active">Tambah Data Murid Madrasah</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

<div>

        <!-- /.card-header -->
        <div class="card-body col-auto">
          <div class="card-body">
            <form action="/murid_madrasah_insert" method="POST" enctype="multipart/form-data">
                <!-- crsf token berfungsi untuk membuat data di laravel -->
               @csrf
               <div class="row">
           <!-- left column -->
           <div class="col-md-6">
             <!-- general form elements -->
             <div class="card card-primary">
               <div class="card-header mb-3">
                 <h3 class="card-title">Tambah Data Murid Madrasah</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               <form>
                 <div class="card-body mb-3">

                    <div class="form-group mb-3">
                        <label for="Kode_Murid" class="form-label">Kode Murid</label>
                        <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                        <?php
                            $tgl = date ('ymdGis');
                        ?>
                            <input type="text" class="form-control" placeholder=""  value="MRD<?php echo $tgl ?>" id="" name="Kode_Murid" readonly>
                        <div name="" class="form-text">Otomatis Terisi</div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="Nama_Murid" class="form-label">Nama Murid</label>
                        <input type="text" class="form-control" placeholder="" id="" name="Nama_Murid">
                    </div>

                    <div class="form-group mb-3">
                        <label for="Tempat_Lahir_Murid" class="form-label">Tempat Lahir Murid</label>
                        <input type="text" class="form-control" placeholder="" id="" name="Tempat_Lahir_Murid">
                    </div>

                    <div class="form-group mb-3">
                        <label for="Tanggal_Lahir_Murid" class="form-label">Tanggal Lahir Murid</label>
                        <input  class="form-control" type="date" id="" name="Tanggal_Lahir_Murid" />
                    </div>

                    <div class="form-group mb-3">
                        <label for="Asal_Sekolah_Murid" class="form-label">Asal Sekolah Murid</label>
                        <input type="text" class="form-control" placeholder="" id="" name="Asal_Sekolah_Murid">
                    </div>

                    <div class="form-group mb-3">
                        <label for="Nama_Ayah_Murid" class="form-label">Nama Ayah Murid</label>
                        <input type="text" class="form-control" placeholder="" id="" name="Nama_Ayah_Murid">
                    </div>

                    <div class="form-group mb-3">
                        <label for="Nama_Ibu_Murid" class="form-label">Nama Ibu Murid</label>
                        <input type="text" class="form-control" placeholder="" id="" name="Nama_Ibu_Murid">
                    </div>

                    <div class="form-group mb-3">
                        <label for="Nama_Wali_Murid" class="form-label">Nama Wali Murid</label>
                        <input type="text" class="form-control" placeholder="" id="" name="Nama_Wali_Murid">
                    </div>

                    <div class="form-group mb-3">
                        <label for="Alamat_Murid" class="form-label">Alamat Murid</label>
                        <textarea class="form-control" name="Alamat_Murid"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="Foto_Murid" class="form-label">Foto Murid</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Foto_Murid" name="Foto_Murid">
                        <label class="custom-file-label" for="exampleInputFile">Foto Murid</label>
                    </div>
                    </div>
                    <script>
                        $('#Foto_Murid').on('change', function () {
                        // Get the file name
                        var fileName = $(this).val();
                        // Remove "C:\fakepath\" from the file path
                        fileName = fileName.replace("C:\\fakepath\\", "");
                        // Replace the "Choose a file" label
                        $(this).next('.custom-file-label').html(fileName);
                        });
                    </script>

                    <div class="form-group mb-3">
                        <label for="Foto_Akta_Kelahiran_Murid" class="form-label">Foto Akta Kelahiran Murid</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Foto_Akta_Kelahiran_Murid" name="Foto_Akta_Kelahiran_Murid">
                        <label class="custom-file-label" for="exampleInputFile">Foto Akta Kelahiran Murid</label>
                    </div>
                    </div>
                    <script>
                        $('#Foto_Akta_Kelahiran_Murid').on('change', function () {
                        // Get the file name
                        var fileName = $(this).val();
                        // Remove "C:\fakepath\" from the file path
                        fileName = fileName.replace("C:\\fakepath\\", "");
                        // Replace the "Choose a file" label
                        $(this).next('.custom-file-label').html(fileName);
                        });
                    </script>

                    <div class="form-group mb-3">
                        <label for="Foto_KK_Murid" class="form-label">Foto KK Murid</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="Foto_KK_Murid" name="Foto_KK_Murid">
                        <label class="custom-file-label" for="exampleInputFile">Foto KK Murid</label>
                    </div>
                    </div>
                    <script>
                        $('#Foto_KK_Murid').on('change', function () {
                        // Get the file name
                        var fileName = $(this).val();
                        // Remove "C:\fakepath\" from the file path
                        fileName = fileName.replace("C:\\fakepath\\", "");
                        // Replace the "Choose a file" label
                        $(this).next('.custom-file-label').html(fileName);
                        });
                    </script>

                    <div class="form-group mb-3">
                        <label for="exampleSelectRounded0">Tingkat Murid</label>
                        <select class="custom-select rounded-0" id="" name="Tingkat_Murid">
                        <option selected disabled value>--Pilih--</option>
                        <option value="1_Satu">1 Satu</option>
                        <option value="2_Dua">2 Dua</option>
                        <option value="3_Tiga">3 Tiga</option>
                        <option value="4_Empat">4 Empat</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="Keterangan_Murid" class="form-label">Keterangan Murid</label>
                        <textarea class="form-control" name="Keterangan_Murid"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleSelectRounded0">Status Murid</label>
                        <select class="custom-select rounded-0" id="" name="Status_Murid">
                        <option selected disabled value>--Pilih--</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak_Aktif">Tidak_Aktif</option>
                        <option value="Pindah">Pindah</option>
                        <option value="Lainya">Lainya</option>
                        </select>
                        <div name="" class="form-text">Pilih Aktif Jika Baru Mendaftar</div>
                    </div>

                 <!-- /.card-body -->

                    <div class="card-footer mb-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-warning ml-2">Reset</button>
                        <a href="/murid_madrasah_data" class="ml-2">
                        <button type="button" class="btn btn-danger">Batal</button>
                        </a>
                    </div>
               </form>
          </div>
        </div>

</div>
<!-- /.card -->


@endsection
