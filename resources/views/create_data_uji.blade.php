<!doctype html>
<html lang="en" data-bs-theme="dark">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Uji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  </head>

  <body>
  
    <h1 class="text-center">Tambah Data Uji</h1>

        <div class="row justify-content-center">

           <!-- Menampilkan form input data-->
           <div class="col-8">
            <!-- membuat form card background-->
            <div class="card">
              <!-- membuat form card content-->
              <div class="card-body">
                <form action="/insert_data_uji" method="POST" enctype="multipart/form-data">
                    <!-- crsf token berfungsi untuk membuat data di laravel -->
                   @csrf
                   <div class="row">
               <!-- left column -->
               <div class="col-md-6">
                 <!-- general form elements -->
                 <div class="card card-primary">
                   <div class="card-header mb-3">
                     <h3 class="card-title">Tambah Data Uji</h3>
                   </div>
                   <!-- /.card-header -->
                   <!-- form start -->
                   <form>
                     <div class="card-body mb-3">
       
                       <div class="form-group mb-3">
                           <label for="kode" class="form-label">Kode</label>
                           <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal--> 
                           <?php
                               $tgl = date ('ymdGis');
                           ?>
                              <input type="text" class="form-control" placeholder=""  value="MRD<?php echo $tgl ?>" id="" name="Kode" readonly>
                           <div name="" class="form-text">Otomatis Terisi</div>
                       </div>
       
                       <div class="form-group mb-3">
                           <label for="Nama" class="form-label">Nama</label>
                           <input type="text" class="form-control" placeholder="" id="" name="Nama">
                       </div>
                       
                       <div class="form-group mb-3">
                           <label for="Password" class="form-label">Password</label>
                           <input type="password" class="form-control" placeholder="" id="" name="Password">
                       </div>
       
                       <div class="form-group mb-3">
                           <label for="Tanggal_masuk" class="form-label">Tanggal Masuk</label>
                           <input  class="form-control" type="date" id="" name="Tanggal_masuk" />
                       </div>

                       <div class="form-group mb-3">
                           <label for="Status" class="form-label">Status</label>
                           <select  class="form-select" type="date" id="" name="Status">
                            <option selected>--Pilih--</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak_Aktif">Tidak_Aktif</option>
                           </select>
                       </div>

                       <div class="form-group mb-3">
                            <label for="Foto1" class="form-label">Foto Uji 1 </label>
                            <input type="file" class="form-control" placeholder="" id="" name="Foto1">
                       </div>

                       <div class="form-group mb-3">
                            <label for="Foto2" class="form-label">Foto Uji 2</label>
                            <input type="file" class="form-control" placeholder="" id="" name="Foto2">
                       </div>
       
                     <!-- /.card-body -->
       
                     <div class="card-footer mb-3">
                       <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                   </form>
              </div>
             </div>
            </div>
           
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>