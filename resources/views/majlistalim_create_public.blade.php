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
                        <div style="display: inline-flex; align-items: center;">
                            <img src="{{ asset('icon_web/Logo_Masjid.png') }}" style="width: 50px;"
                                alt="Madrasah DKMBKU Logo">
                            <h3 class="card-title" style="margin-left: 10px;">Pendaftaran Majlistalim</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- crsf token berfungsi untuk membuat data di laravel -->
                        <form action="majlistalim_insert_public" method="POST" enctype="multipart/form-data">
                            @csrf
                            <form>

                                <div class="form-group mb-3">
                                    <label for="Kode_Majlistalim" class="form-label">Kode Majlistalim</label>
                                    <!-- tag php dan echo ?php disini utk membuat primary key secara otomatis menggunakan tanggal-->
                                    <?php
                                    $tgl = date('ymdGis');
                                    ?>
                                    <input type="text" class="form-control" placeholder=""
                                        value="MJTM-<?php echo $tgl; ?>" id="Kode_Majlistalim" name="Kode_Majlistalim"
                                        readonly>
                                    <div name="" class="form-text">Otomatis Terisi Tidak Bisa Diubah</div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Nama_Majlistalim" class="form-label">Nama Majlistalim</label>
                                    <input type="text" class="form-control" placeholder="" id="Nama_Majlistalim"
                                        name="Nama_Majlistalim" value="{{ old('Nama_Majlistalim') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Nama_Majlistalim')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Penanggung_Jawab_Majlistalim" class="form-label">Penanggung
                                        Jawab Majlistalim</label>
                                    <input type="text" class="form-control" placeholder=""
                                        id="Penanggung_Jawab_Majlistalim" name="Penanggung_Jawab_Majlistalim"
                                        value="{{ old('Penanggung_Jawab_Majlistalim') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Penanggung_Jawab_Majlistalim')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="Kontak_Majlistalim" class="form-label">Kontak
                                        Majlistalim</label>
                                    <input type="text" class="form-control" placeholder="" id="Kontak_Majlistalim"
                                        name="Kontak_Majlistalim" value="{{ old('Kontak_Majlistalim') }}">
                                    {{-- pemberitahuan validator --}}
                                    @error('Kontak_Majlistalim')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- syntax input gambar --}}
                                <div class="form-group mb-3">
                                    <label for="Logo_Majlistalim" class="form-label">Logo Majlistalim</label>
                                    <div class="custom-file">
                                        <input class="form-control" type="file" id="Logo_Majlistalim"
                                            name="Logo_Majlistalim">
                                    </div>
                                    <!-- Image preview -->
                                    <div id="Preview_Logo_Majlistalim" class="mt-2">
                                        <img src="#" alt="" style="max-width: 100%; max-height: 200px;">
                                    </div>
                                </div>

                                <script>
                                    // JavaScript for image preview
                                    document.getElementById("Logo_Majlistalim").addEventListener("change", function() {
                                        // Get the file input
                                        var fileInput = this;

                                        // Get the file selected
                                        var file = fileInput.files[0];

                                        // Create a FileReader object
                                        var reader = new FileReader();

                                        // Set up the FileReader onload event
                                        reader.onload = function(e) {
                                            // Get the preview image element
                                            var previewImage = document.getElementById("Preview_Logo_Majlistalim").getElementsByTagName(
                                                "img")[
                                                0];

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
                                    <label for="Keterangan_Majlistalim" class="form-label">Keterangan
                                        Majlistalim</label>
                                    <textarea class="form-control" name="Keterangan_Majlistalim" id="Keterangan_Majlistalim" readonly>{{ old('Keterangan_Majlistalim', 'Pending') }}</textarea>
                                    <div name="" class="form-text">Tidak bisa diubah</div>
                                </div>

                                {{-- style="display: none;" untuk menonaktifkan visible sebuah elemen atau input --}}
                                <div class="form-group mb-3" style="display: none;">
                                    <label for="Status_Majlistalim">Status Majlistalim</label>
                                    <select class="form-select" id="Status_Majlistalim" name="Status_Majlistalim">
                                        <option value="Lainya"
                                            {{ old('Status_Majlistalim', 'Lainya') == 'Lainya' ? 'selected' : '' }}>
                                            Lainya
                                        </option>
                                    </select>
                                    {{-- Validator notification --}}
                                    @error('Status_Majlistalim')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div name="" class="form-text">Tidak bisa diubah</div>
                                </div>




                                <!-- /.card-body -->

                                <div class="card-footer mb-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-warning ml-2" name="resetButton"
                                        id="resetButton">Reset</button>
                                </div>

                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // JavaScript for refreshing the page on button click
        document.getElementById("resetButton").addEventListener("click", function() {
            // Reload the current page
            location.reload();
        });
    </script>


</body>

</html>
