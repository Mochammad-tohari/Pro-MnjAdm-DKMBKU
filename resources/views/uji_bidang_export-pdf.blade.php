<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #uji_bidang_data {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #uji_bidang_data th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #uji_bidang_data td,
        #uji_bidang_data th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #uji_bidang_data tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Uji Bidang</h1>
    <div style="overflow-x: auto;">
        <table id="uji_bidang_data">
            <tr>
                <th>Nomor</th>
                <th>Kode Bidang</th>
                <th>Nama Bidang</th>
                <th>Keterangan Bidang</th>
                <th>Status Bidang</th>

                <th>Tanggal Data Dibuat</th>

            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($uji_bidang_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Bidang }}</th>
                    <td>{{ $row->Nama_Bidang }}</td>
                    <td>{{ $row->Keterangan_Bidang }}</td>
                    <td>{{ $row->Status_Bidang }}</td>


                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
