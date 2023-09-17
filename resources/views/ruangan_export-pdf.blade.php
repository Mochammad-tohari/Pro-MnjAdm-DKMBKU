

<!DOCTYPE html>
<html>
<head>


<style type="text/css">


        #ruangan {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 9pt;
        /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
        size: 297mm 210mm;
        }

        #ruangan th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }

        #ruangan td, #ruangan th {
        border: 1px solid #ddd;
        padding: 2px;
        }

        #ruangan tr:nth-child(even){background-color: #f2f2f2;}

	</style>


</head>
<body>

        <h1>Tabel Data Ruangan</h1>
    <div style="overflow-x: auto;">
        <table id="ruangan">
        <tr>
            <th>Nomor</th>
            <th>Lokasi Gedung</th>
            <th>Kode Ruangan</th>
            <th>Nama Ruangan</th>
            <th>Luas Ruangan</th>
            <th>Tanggal Operasional</th>
            <th>Keterangan Ruangan</th>
            <th>Status Ruangan</th>

            <th>Tanggal Data Dibuat</th>
        </tr>

        @php
            $nomor = 1;
        @endphp

        @foreach ($ruangan_data as $row)

        <tr>

                            <td>{{$nomor++}}</td>
                            <th scope="row">{{ $row->gedung->Nama_Gedung }}</th>
                            <th scope="row">{{$row->Kode_Ruangan }}</th>
                            <td>{{$row->Nama_Ruangan}}</td>
                            <td>{{$row->Luas_Ruangan}}</td>
                            <td>{{$row->Tanggal_Operasional_Ruangan}}</td>
                            <td>{{$row->Keterangan_Ruangan}}</td>
                            <td>{{$row->Status_Ruangan}}</td>

                            <td>{{$row->created_at->format('D,d M Y')}}</td>
        </tr>


        @endforeach


        </table>
    </div>


        </body>


</html>

