<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <title>Pendaftaran Majlistalim DKMBKU</title>
</head>

<body>
    <h1>Terima Kasih, Pendaftaran Majlistalim Telah Selesai!</h1>

    <h2>Berikut adalah informasi pendaftaran Majlistalim :</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" id="majlistalim-pendaftar">

                    <div class="card-header">
                        <div style="display: inline-flex; align-items: center;">
                            <img src="{{ asset('icon_web/Logo_Masjid.png') }}" style="width: 50px;"
                                alt="Madrasah DKMBKU Logo">
                            <h3 class="card-title" style="margin-left: 10px;">Kartu Pendaftar</h3>
                        </div>
                    </div>

                    <div class="card-Body">
                        <ul>
                            <li><strong>Kode Majlistalim :</strong> {{ $Kode_Majlistalim }}</li>
                            <li><strong>Nama Majlistalim :</strong> {{ $Nama_Majlistalim }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Add a button to trigger screenshot -->
            <div class="row justify-content-center mt-3"> <!-- Adjust the 'mt-3' class to change the vertical gap -->
                <div class="col-md-6 text-center">
                    <button id="button_download" class="btn btn-success btn-sm"
                        onclick="takeScreenshot()">Download</button>
                </div>
            </div>
        </div>
    </div>

    <h3 style="color: red;">Harap Klik "Download" Kartu Pendaftar dan Hubungi pengurus DKMBKU !</h3>




    <!-- Import html2canvas script -->
    {{-- src="{{ secure_asset('js/html2canvas/html2canvas.js') }}"
        "secure_asset agar bisa diakses di link "Https" atau di ngrok --}}
    <script src="{{ secure_asset('js/html2canvas/html2canvas.js') }}"></script>

    <script>
        // Prevent closing the page until the user clicks download button
        window.addEventListener('beforeunload', function(e) {
            e.preventDefault();
            e.returnValue = '';
        });

        function takeScreenshot() {
            // Select the element to be captured
            var element = document.getElementById('majlistalim-pendaftar');

            // Use html2canvas to capture the element
            html2canvas(element).then(function(canvas) {
                // Convert the canvas to a data URL
                var imgData = canvas.toDataURL('image/png');

                // Create a temporary link element
                var link = document.createElement('a');

                // mengatur file download sesuai dengan nilai Nama_Majlistalim
                var fileName = '{{ $Nama_Majlistalim }} ' + '_Pndftr_MJMT.png';

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
</body>

</html>
