<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Gedung View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link href="{{ asset('Design/gedung_sign.css') }}" rel="stylesheet">

</head>

<body>



    <h1>Gedung</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="gedung-card card-primary" id="gedung-card">


                    <div class="card-body">

                        <table id="gedung_table" style=" width: 500px;">


                            <tr id="Nama_Gedung" style="margin-top: 20px;">
                                <th style="  padding: 10px; text-align: center;" colspan="2">
                                    {{ $gedung_data->Nama_Gedung }}
                                </th>
                            </tr>

                            <tr id="Kode_Gedung" style="margin-top: 20px;">
                                <th style=" padding: 10px; text-align: center;" colspan="2">
                                    {{ $gedung_data->Kode_Gedung }}
                                </th>
                            </tr>

                        </table>
                    </div>



                </div>
            </div>
        </div>
    </div>


    {{-- awal syntax ss nametag --}}
    <!-- Add a button to trigger screenshot -->
    <div class="container ">
        <div class="row ">
            <div class="col-md-6 text-center">
                <button id="button_download" class="mb-2 btn btn-success  btn-sm mb-2"
                    onclick="takeScreenshot()">Download</button>
            </div>
        </div>
    </div>

    <!-- Import html2canvas script -->
    <script src="{{ asset('js/html2canvas/html2canvas.js') }}"></script>

    <script>
        function takeScreenshot() {
            // Select the element to be captured
            var element = document.getElementById('gedung-card');

            // Use html2canvas to capture the element
            html2canvas(element).then(function(canvas) {
                // Convert the canvas to a data URL
                var imgData = canvas.toDataURL('image/png');

                // Create a temporary link element
                var link = document.createElement('a');

                // mengatur file download sesuai dengan nilai Nama_Uji_User
                var fileName = ' {{ $gedung_data->Nama_Gedung }}' + '_GDG.png';

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
