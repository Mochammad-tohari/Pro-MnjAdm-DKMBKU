

<!DOCTYPE html>
<html>
<head>


<style type="text/css">


        #gedung {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 9pt;
        /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
        size: 297mm 210mm;
        }

        #gedung th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }

        #gedung td, #gedung th {
        border: 1px solid #ddd;
        padding: 2px;
        }

        #gedung tr:nth-child(even){background-color: #f2f2f2;}

	</style>


</head>
<body>

        <h1>Tabel Data Gedung</h1>
    <div style="overflow-x: auto;">
        <table id="gedung">
        <tr>
            <th>Nomor</th>
            <th>Kode Gedung</th>
            <th>Nama Gedung</th>
            <th>Dimensi Gedung</th>
            <th>Tanggal Operasional</th>
            <th>Keterangan Gedung</th>
            <th>Status Gedung</th>

            <th>Tanggal Data Dibuat</th>
        </tr>

        @php
            $nomor = 1;
        @endphp

        @foreach ($gedung_data as $row)

        <tr>

                            <td>{{$nomor++}}</td>
                            <th scope="row">{{$row->Kode_Gedung }}</th>
                            <td>{{$row->Nama_Gedung}}</td>
                            <td>{{$row->Dimensi_Gedung}}</td>
                            <td>{{$row->Tanggal_Operasional_Gedung}}</td>
                            <td>{{$row->Keterangan_Gedung}}</td>
                            <td>{{$row->Status_Gedung}}</td>

                            <td>{{$row->created_at->format('D,d M Y')}}</td>
        </tr>


        @endforeach


        </table>
    </div>


        </body>


</html>

