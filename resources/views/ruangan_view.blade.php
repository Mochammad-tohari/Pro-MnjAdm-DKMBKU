<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Ruangan View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link href="{{ asset('Design/ruangan_sign.css') }}" rel="stylesheet">

  </head>
  <body>



    <h1>Ruangan</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card-ruangan card-primary">


                    <div class="card-body">

                        <table id="ruangan_tag" >

                            <tr>
                                <th class="ruangan_nama" colspan="2" style="text-align: center; font-family: 'Times New Roman', Times, serif;"><b>{{$ruangan_data->Nama_Ruangan}}</b></th>
                            </tr>


                            <tr>
                                {{-- <td>Kode</td> --}}
                                <td class="kode-text">{{$ruangan_data->Kode_Ruangan}}</td>
                            </tr>

                        </table>
                    </div>



            </div>
        </div>
    </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  </body>

</html>
