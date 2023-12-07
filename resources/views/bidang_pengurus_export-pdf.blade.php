<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #bidang_pengurus {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #bidang_pengurus th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #bidang_pengurus td,
        #bidang_pengurus th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #bidang_pengurus tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Bidang Pengurus</h1>
    <div style="overflow-x: auto;">
        <table id="bidang_pengurus">
            <tr>
                <th>Nomor</th>
                <th>Kode Bidang Pengurus</th>
                <th>Nama Bidang Pengurus</th>
                <th>Keterangan Bidang Pengurus</th>
                <th>Status Bidang Pengurus</th>

                <th>Tanggal Data Dibuat</th>

            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($bidang_pengurus_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Bidang_Pengurus }}</th>
                    <td>{{ $row->Nama_Bidang_Pengurus }}</td>
                    <td>{{ $row->Keterangan_Bidang_Pengurus }}</td>
                    <td>{{ $row->Status_Bidang_Pengurus }}</td>


                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
