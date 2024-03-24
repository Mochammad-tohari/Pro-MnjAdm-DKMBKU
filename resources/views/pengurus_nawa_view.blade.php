<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Khodim DKM View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link href="{{ asset('Design/pengurus_nawa_nametag.css') }}" rel="stylesheet">

</head>

<body>

    <h2>Nametag Uji User</h2>

    <div class="container mb-4">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="pengurus-nawa-card card-primary" id="pengurus-nawa-card">

                    <div class="card-body">

                        <div class="form-group row Foto_Pengurus_Nawa">
                            <img src="{{ asset('Data_Pengurus_Nawa/Foto_Pengurus_Nawa/' . $pengurus_nawa_data->Foto_Pengurus_Nawa) }}"
                                alt="Foto_Pengurus_Nawa">
                        </div>

                        <table id="pengurus_nawa_table" style=" width: 300px;">

                            <tr id="Nama_Pengurus_Nawa" style="margin-top: 20px;">
                                <th style="border-bottom: 1px solid black; padding: 10px; text-align: center;"
                                    colspan="2">
                                    {{ $pengurus_nawa_data->Nama_Pengurus_Nawa }}
                                </th>
                            </tr>

                            <tr id="Kode_Pengurus_Nawa">
                                <td style="border-bottom: 1px solid black; padding: 10px; text-align: center;">
                                    {{ $pengurus_nawa_data->Kode_Pengurus_Nawa }}
                                </td>
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
            var element = document.getElementById('pengurus-nawa-card');

            // Use html2canvas to capture the element
            html2canvas(element).then(function(canvas) {
                // Convert the canvas to a data URL
                var imgData = canvas.toDataURL('image/png');

                // Create a temporary link element
                var link = document.createElement('a');

                // mengatur file download sesuai dengan nilai Nama_Pengurus_Nawa
                var fileName = '{{ $pengurus_nawa_data->Nama_Pengurus_Nawa }}' + '_PRSNW.png';

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