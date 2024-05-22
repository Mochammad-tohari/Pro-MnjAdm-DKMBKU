<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #pengajar_madrasah {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 7pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 420mm 300mm;
        }

        #pengajar_madrasah th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #pengajar_madrasah td,
        #pengajar_madrasah th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #pengajar_madrasah tr:nth-child(even) {
            background-color: #ebebeb;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Pengajar Madrasah</h1>
    <div style="overflow-x: auto;">
        <table id="pengajar_madrasah">
            <tr>
                <th style="">Nomor</th>

                <th scope="col">Kode Pengajar</th>
                <th scope="col">Nama Pengajar</th>
                <th scope="col">Kontak Pengajar</th>
                <th scope="col">Alamat Pengajar</th>
                <th scope="col">Keterangan Pengajar</th>
                <th scope="col">Status Pengajar</th>

            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($pengajar_madrasah_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Pengajar }}</th>
                    <td>{{ $row->Nama_Pengajar }}</td>
                    <td>{{ $row->Kontak_Pengajar }}</td>
                    <td>{{ $row->Alamat_Pengajar }}</td>
                    <td>{{ $row->Keterangan_Pengajar }}</td>
                    <td>{{ $row->Status_Pengajar }}</td>


                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
