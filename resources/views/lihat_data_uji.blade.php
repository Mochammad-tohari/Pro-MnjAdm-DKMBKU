<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Uji View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <h1>Data Uji View</h1>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title mb-2" style="text-align: center;">Kartu Identitas</h3>
                </div>
        
                <form>
                    <div class="card body">
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Kode</b></label>
                            {{$data_uji->Kode}}
                        </div>
                
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Nama</b></label>
                            {{$data_uji->Nama}}
                        </div>
                
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Password</b></label>
                            {{$data_uji->Password}}
                        </div>
                
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Tanggal_masuk</b></label>
                            {{$data_uji->Tanggal_masuk}}
                        </div>
                
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Status</b></label>
                            {{$data_uji->Status}}
                        </div>
                
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Foto1</b></label>
                            <img src="{{ asset('storage/folder_foto1/' . $data_uji->Foto1) }}" alt="Foto 1" style="width: 80px;">
                        </div>
                
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Foto2</b></label>
                            <img src="{{ asset('storage/folder_foto2/' . $data_uji->Foto2) }}" alt="Foto 1" style="width: 80px;">
                        </div>
                
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 col-label-form"><b>Tanggal Data Dibuat</b></label>
                            {{$data_uji->created_at->format('D,d M Y')}}
                        </div>
                
                       </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
  </body>

</html>