<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #bidang_pengurus_dkm {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #bidang_pengurus_dkm th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #bidang_pengurus_dkm td,
        #bidang_pengurus_dkm th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #bidang_pengurus_dkm tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Bidang Pengurus</h1>
    <div style="overflow-x: auto;">
        <table id="bidang_pengurus_dkm">
            <tr>
                <th>Nomor</th>
                <th>Kode Bidang Pengurus DKM</th>
                <th>Nama Bidang Pengurus DKM</th>
                <th>Keterangan Bidang Pengurus DKM</th>
                <th>Status Bidang Pengurus DKM</th>

                <th>Tanggal Data Dibuat</th>

            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($bidang_pengurus_dkm_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Bidang_Pengurus_DKM }}</th>
                    <td>{{ $row->Nama_Bidang_Pengurus_DKM }}</td>
                    <td>{{ $row->Keterangan_Bidang_Pengurus_DKM }}</td>
                    <td>{{ $row->Status_Bidang_Pengurus_DKM }}</td>


                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
