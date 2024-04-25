<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Inventaris View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>

<body>

    <div class="container mt-5"> <!-- Increased mt-5 for more space -->
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card text-center" id="majlistalim-card" data-bs-theme="light">
                    <div class="card-header">
                        <div style="display: inline-flex; align-items: center;">
                            <img src="{{ asset('icon_web/Logo_Masjid.png') }}" style="width: 50px;" alt="Logo_Masjid">
                            <h3 class="card-title" style="margin-left: 10px;">Majlistalim DKMBKU</h3>
                        </div>
                    </div>

                    <div class="card-Body text-start" style="padding-left: 20px;">
                        <p><strong>Kode Majlistalim :</strong> {{ $majlistalim_data->Kode_Majlistalim }}</p>
                        <p><strong>Nama Majlistalim :</strong> {{ $majlistalim_data->Nama_Majlistalim }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add a button to trigger screenshot -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-6 text-center">
                <button id="button_download" class="btn btn-success btn-sm" onclick="takeScreenshot()">Download</button>
            </div>
        </div>
    </div>





    {{-- awal syntax ss nametag --}}
    <!-- Import html2canvas script -->
    {{-- src="{{ secure_asset('js/html2canvas/html2canvas.js') }}"
        "secure_asset agar bisa diakses di link "Https" atau di ngrok --}}
    <script src="{{ asset('js/html2canvas/html2canvas.js') }}"></script>


    <script>
        function takeScreenshot() {
            // Select the element to be captured
            var element = document.getElementById('majlistalim-card');

            // Use html2canvas to capture the element
            html2canvas(element).then(function(canvas) {
                // Convert the canvas to a data URL
                var imgData = canvas.toDataURL('image/png');

                // Create a temporary link element
                var link = document.createElement('a');

                // mengatur file download sesuai dengan nilai Nama_Majlistalim
                var fileName = '{{ $majlistalim_data->Nama_Majlistalim }}' + '_MJMT.png';

                link.href = imgData;
                link.download = fileName;

                // Append the link to the body and trigger the click event
                document.body.appendChild(link);
                link.click();

                // Remove the temporary link
                document.body.removeChild(link);
            });
        }
    </script>

    {{-- akhir syntax ss nametag --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
