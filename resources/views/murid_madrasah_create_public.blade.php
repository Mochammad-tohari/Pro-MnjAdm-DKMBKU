<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <title>Pendaftaran Murid Madrasah DKMBKU</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">

                    <div class="card-header">
                        <div style="display: inline-flex; align-items: center;">
                            <img src="{{ asset('box_info_image/Logo_Madrasah_DKMBKU.png') }}" style="width: 50px;"
                                alt="Madrasah DKMBKU Logo">
                            <h3 class="card-title" style="margin-left: 10px;">Pendaftaran Murid Madrasah DKMBKU</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        <form action="/murid_madrasah_insert_public" method="POST" enctype="multipart/form-data">
                            @csrf
                            <form>

                                <div class="form-group mb-3">
                                    <label for="Kode_Murid" class="form-label">Kode Murid</label>
                                    <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                    <?php
                                    $tgl = date('ymdGis');
                                    ?>
                                    <input type="text" class="form-control" placeholder=""
                                        value="MRD-<?php echo $tgl; ?>" id="Kode_Murid" name="Kode_Murid" readonly>
                                    <div name="" class="form-text">Otomatis Terisi</div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Nama_Murid" class="form-label">Nama Murid</label>
                                    <input type="text" class="form-control" placeholder="" id="Nama_Murid"
                                        name="Nama_Murid" value="{{ old('Nama_Murid') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Nama_Murid')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Tempat_Lahir_Murid" class="form-label">Tempat Lahir
                                        Murid</label>
                                    <input type="text" class="form-control" placeholder="" id="Tempat_Lahir_Murid"
                                        name="Tempat_Lahir_Murid" value="{{ old('Tempat_Lahir_Murid') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Tempat_Lahir_Murid')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Tanggal_Lahir_Murid" class="form-label">Tanggal Lahir
                                        Murid</label>
                                    <input class="form-control" type="date" id="Tanggal_Lahir_Murid"
                                        name="Tanggal_Lahir_Murid" value="{{ old('Tanggal_Lahir_Murid') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Tanggal_Lahir_Murid')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Asal_Sekolah_Murid" class="form-label">Asal Sekolah
                                        Murid</label>
                                    <input type="text" class="form-control" placeholder="" id="Asal_Sekolah_Murid"
                                        name="Asal_Sekolah_Murid" value="{{ old('Asal_Sekolah_Murid') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Asal_Sekolah_Murid')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Nama_Ayah_Murid" class="form-label">Nama Ayah Murid</label>
                                    <input type="text" class="form-control" placeholder="" id="Nama_Ayah_Murid"
                                        name="Nama_Ayah_Murid" value="{{ old('Nama_Ayah_Murid') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Nama_Ibu_Murid" class="form-label">Nama Ibu Murid</label>
                                    <input type="text" class="form-control" placeholder="" id="Nama_Ibu_Murid"
                                        name="Nama_Ibu_Murid" value="{{ old('Nama_Ibu_Murid') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Nama_Wali_Murid" class="form-label">Nama Wali Murid</label>
                                    <input type="text" class="form-control" placeholder="" id="Nama_Wali_Murid"
                                        name="Nama_Wali_Murid" value="{{ old('Nama_Wali_Murid') }}">
                                    <div name="" class="form-text">Bisa dikosongkan
                                        jika sudah ada data orang tua</div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Kontak_Murid" class="form-label">Kontak Murid</label>
                                    <input type="text" class="form-control" placeholder="" id="Kontak_Murid"
                                        name="Kontak_Murid" value="{{ old('Kontak_Murid') }}">
                                    <div name="" class="form-text">Nomor Orang tua/wali murid</div>
                                    {{-- pemberitahuan validator --}}
                                    @error('Kontak_Murid')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Alamat_Murid" class="form-label">Alamat Murid</label>
                                    <textarea class="form-control" name="Alamat_Murid" id="Alamat_Murid">{{ old('Alamat_Murid') }}</textarea>
                                    {{-- pemberitahuan validator --}}
                                    @error('Alamat_Murid')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- syntax input gambar --}}
                                <div class="form-group mb-3">
                                    <label for="Foto_Murid" class="form-label">Foto Murid</label>
                                    <div class="custom-file">
                                        <input class="form-control" type="file" id="Foto_Murid"
                                            name="Foto_Murid">
                                    </div>
                                    <!-- Image preview -->
                                    <div id="Preview_Foto_Murid" class="mt-2">
                                        <img src="#" alt=""
                                            style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>

                                <script>
                                    // JavaScript for image preview
                                    document.getElementById("Foto_Murid").addEventListener("change", function() {
                                        // Get the file input
                                        var fileInput = this;

                                        // Get the file selected
                                        var file = fileInput.files[0];

                                        // Create a FileReader object
                                        var reader = new FileReader();

                                        // Set up the FileReader onload event
                                        reader.onload = function(e) {
                                            // Get the preview image element
                                            var previewImage = document.getElementById("Preview_Foto_Murid").getElementsByTagName("img")[0];

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
                                    <label for="Foto_Akta_Kelahiran_Murid" class="form-label">Foto Akta Kelahiran
                                        Murid</label>
                                    <div class="custom-file">
                                        <input class="form-control" type="file" id="Foto_Akta_Kelahiran_Murid"
                                            name="Foto_Akta_Kelahiran_Murid">
                                    </div>
                                    <!-- Image preview -->
                                    <div id="Preview_Foto_Akta_Kelahiran_Murid" class="mt-2">
                                        <img src="#" alt=""
                                            style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>

                                <script>
                                    // JavaScript for image preview
                                    document.getElementById("Foto_Akta_Kelahiran_Murid").addEventListener("change", function() {
                                        // Get the file input
                                        var fileInput = this;

                                        // Get the file selected
                                        var file = fileInput.files[0];

                                        // Create a FileReader object
                                        var reader = new FileReader();

                                        // Set up the FileReader onload event
                                        reader.onload = function(e) {
                                            // Get the preview image element
                                            var previewImage = document.getElementById("Preview_Foto_Akta_Kelahiran_Murid")
                                                .getElementsByTagName("img")[0];

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
                                    <label for="Foto_KK_Murid" class="form-label">Foto Kartu Keluarga</label>
                                    <div class="custom-file">
                                        <input class="form-control" type="file" id="Foto_KK_Murid"
                                            name="Foto_KK_Murid">
                                    </div>
                                    <!-- Image preview -->
                                    <div id="Preview_KK_Murid" class="mt-2">
                                        <img src="#" alt=""
                                            style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>

                                <script>
                                    // JavaScript for image preview
                                    document.getElementById("Foto_KK_Murid").addEventListener("change", function() {
                                        // Get the file input
                                        var fileInput = this;

                                        // Get the file selected
                                        var file = fileInput.files[0];

                                        // Create a FileReader object
                                        var reader = new FileReader();

                                        // Set up the FileReader onload event
                                        reader.onload = function(e) {
                                            // Get the preview image element
                                            var previewImage = document.getElementById("Preview_KK_Murid").getElementsByTagName("img")[0];

                                            // Set the source of the image preview to the result of FileReader
                                            previewImage.src = e.target.result;
                                        };

                                        // Read the file as a data URL
                                        reader.readAsDataURL(file);
                                    });
                                </script>
                                {{-- akhir syntax input gambar --}}

                                {{-- style="display: none;" untuk menonaktifkan visible sebuah elemen atau input --}}
                                <div class="form-group mb-3" style="display: none;">
                                    <label for="Tingkat_Murid">Tingkat Murid</label>
                                    <select class="form-select" id="Tingkat_Murid" name="Tingkat_Murid">
                                        <option value="1_Satu"
                                            {{ old('Tingkat_Murid', '1_Satu') == '1_Satu' ? 'selected' : '' }}>1 Satu
                                        </option>
                                    </select>
                                    <div name="" class="form-text">Tidak bisa diubah</div>
                                    {{-- pemberitahuan validator --}}
                                    @error('Tingkat_Murid')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group mb-3" style="display: none;">
                                    <label for="Keterangan_Murid" class="form-label">Keterangan
                                        Murid</label>
                                    <textarea class="form-control" name="Keterangan_Murid" id="Keterangan_Murid" readonly>{{ old('Keterangan_Murid', 'Pending') }}</textarea>
                                    <div name="" class="form-text">Tidak bisa diubah</div>
                                </div>


                                <div class="form-group mb-3" style="display: none;">
                                    <label for="Status_Murid">Status Murid</label>
                                    <select class="form-select" id="Status_Murid" name="Status_Murid"
                                        @readonly(true)>
                                        <option value="Lainya"
                                            {{ old('Status_Murid', 'Lainya') == 'Lainya' ? 'selected' : '' }}>
                                            Lainya</option>
                                    </select>
                                    {{-- pemberitahuan validator --}}
                                    @error('Status_Murid')
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
