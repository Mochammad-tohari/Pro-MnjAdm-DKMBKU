<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <title>Pendaftaran Uji User DKMBKU</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pendaftaran Uji User DKMBKU</h3>
                    </div>
                    <div class="card-body">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        <form action="/uji_user_insert_public" method="POST" enctype="multipart/form-data">
                            @csrf
                            <form>

                                <div class="form-group mb-3">
                                    <label for="id" class="form-label">Kode Uji User</label>
                                    <!-- tag php dan echo ?php disini utk membuat Kode key secara otomatis menggunakan tanggal-->
                                    <?php
                                    $tgl = date('ymdGis');
                                    ?>
                                    <input type="text" class="form-control" placeholder=""
                                        value="UJUSR-<?php echo $tgl; ?>" id="Kode_Uji_User" name="Kode_Uji_User"
                                        readonly>
                                    <div name="" class="form-text">Otomatis Terisi</div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="id" class="form-label">Jabatan Uji User</label>
                                    <select class="form-select" id="Jabatan_Uji_User" name="Jabatan_Uji_User">
                                        <option selected disabled value>--Pilih--</option>
                                        {{-- memanggil variable $Uji_Bidang_Options yang ada di ruangan controller
                                        mendefinisikan sebagai variable $Kode_Bidang
                                        yang akan di tampilkan sebagai {{ $Nama_Bidang }} di table uji_bidang --}}
                                        {{-- Sort the $Uji_Bidang_Options array by the values (Jabatan Pengurus) in ascending order --}}
                                        @php
                                            $Sorted_Uji_Bidang_Options = collect($Uji_Bidang_Options)->sort()->all();
                                        @endphp
                                        {{-- Loop through the sorted array --}}
                                        @foreach ($Sorted_Uji_Bidang_Options as $Kode_Bidang => $Nama_Bidang)
                                            <option value="{{ $Kode_Bidang }}"
                                                {{ old('Jabatan_Uji_User') == $Kode_Bidang ? 'selected' : '' }}>
                                                {{ $Nama_Bidang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- pemberitahuan validator --}}
                                    @error('Jabatan_Uji_User')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Nama_Uji_User" class="form-label">Nama Uji User</label>
                                    <input type="text" class="form-control" placeholder="" id="Nama_Uji_User"
                                        name="Nama_Uji_User" value="{{ old('Nama_Uji_User') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Nama_Uji_User')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Password_Uji_User" class="form-label">Password Uji User</label>
                                    <input type="password" class="form-control" placeholder="" id="Password_Uji_User"
                                        name="Password_Uji_User" value="{{ old('Password_Uji_User') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Password_Uji_User')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Tanggal_Uji_User" class="form-label">Tanggal Uji User</label>
                                    <input type="date" class="form-control" placeholder="" id="Tanggal_Uji_User"
                                        name="Tanggal_Uji_User" value="{{ old('Tanggal_Uji_User') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Tanggal_Uji_User')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group mb-3">
                                    <label for="Keterangan_Uji_User" class="form-label">Keterangan
                                        Uji User</label>
                                    <textarea class="form-control" name="Keterangan_Uji_User" id="Keterangan_Uji_User" readonly>{{ old('Keterangan_Uji_User', 'Pending') }}</textarea>
                                    <div name="" class="form-text">Tidak bisa diubah</div>
                                </div>


                                {{-- syntax input gambar --}}
                                <div class="form-group mb-3">
                                    <label for="Foto_Profil" class="form-label">Foto Murid</label>
                                    <div class="custom-file">
                                        <input class="form-control" type="file" id="Foto_Profil" name="Foto_Profil">
                                    </div>
                                    <!-- Image preview -->
                                    <div id="Preview_Foto_Profil" class="mt-2">
                                        <img src="#" alt="" style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>

                                <script>
                                    // JavaScript for image preview
                                    document.getElementById("Foto_Profil").addEventListener("change", function() {
                                        // Get the file input
                                        var fileInput = this;

                                        // Get the file selected
                                        var file = fileInput.files[0];

                                        // Create a FileReader object
                                        var reader = new FileReader();

                                        // Set up the FileReader onload event
                                        reader.onload = function(e) {
                                            // Get the preview image element
                                            var previewImage = document.getElementById("Preview_Foto_Profil").getElementsByTagName("img")[
                                                0];

                                            // Set the source of the image preview to the result of FileReader
                                            previewImage.src = e.target.result;
                                        };

                                        // Read the file as a data URL
                                        reader.readAsDataURL(file);
                                    });
                                </script>
                                {{-- akhir syntax input gambar --}}


                                {{-- syntax input gambar --}}
                                <div class="form-group mb-3">
                                    <label for="Foto_Identitas" class="form-label">Foto Akta Kelahiran
                                        Murid</label>
                                    <div class="custom-file">
                                        <input class="form-control" type="file" id="Foto_Identitas"
                                            name="Foto_Identitas">
                                    </div>
                                    <!-- Image preview -->
                                    <div id="Preview_Foto_Identitas" class="mt-2">
                                        <img src="#" alt=""
                                            style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>

                                <script>
                                    // JavaScript for image preview
                                    document.getElementById("Foto_Identitas").addEventListener("change", function() {
                                        // Get the file input
                                        var fileInput = this;

                                        // Get the file selected
                                        var file = fileInput.files[0];

                                        // Create a FileReader object
                                        var reader = new FileReader();

                                        // Set up the FileReader onload event
                                        reader.onload = function(e) {
                                            // Get the preview image element
                                            var previewImage = document.getElementById("Preview_Foto_Identitas")
                                                .getElementsByTagName("img")[0];

                                            // Set the source of the image preview to the result of FileReader
                                            previewImage.src = e.target.result;
                                        };

                                        // Read the file as a data URL
                                        reader.readAsDataURL(file);
                                    });
                                </script>
                                {{-- akhir syntax input gambar --}}


                                <div class="form-group mb-3">
                                    <label for="Status_Uji_User">Status Murid</label>
                                    <select class="form-select" id="Status_Uji_User" name="Status_Uji_User"
                                        @readonly(true)>
                                        <option value="Lainya"
                                            {{ old('Status_Uji_User', 'Lainya') == 'Lainya' ? 'selected' : '' }}>
                                            Lainya</option>
                                    </select>
                                    {{-- pemberitahuan validator --}}
                                    @error('Status_Uji_User')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div name="" class="form-text">Tidak bisa diubah
                                    </div>
                                </div>



                                <!-- /.card-body -->

                                <div class="card-footer mb-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-warning ml-2">Reset</button>
                                </div>

                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





</body>

</html>
