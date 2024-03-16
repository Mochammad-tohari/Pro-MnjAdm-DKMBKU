<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #bidang_nawa {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #bidang_nawa th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #bidang_nawa td,
        #bidang_nawa th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #bidang_nawa tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Bidang Nawa</h1>
    <div style="overflow-x: auto;">
        <table id="bidang_nawa">
            <tr>
                <th>Nomor</th>
                <th>Kode Bidang Nawa</th>
                <th>Nama Bidang Nawa</th>
                <th>Keterangan Bidang Nawa</th>
                <th>Status Bidang Nawa</th>

                <th>Tanggal Data Dibuat</th>

            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($bidang_nawa_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Bidang_Nawa }}</th>
                    <td>{{ $row->Nama_Bidang_Nawa }}</td>
                    <td>{{ $row->Keterangan_Bidang_Nawa }}</td>
                    <td>{{ $row->Status_Bidang_Nawa }}</td>


                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
