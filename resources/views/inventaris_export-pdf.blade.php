<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #inventaris {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #inventaris th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #inventaris td,
        #inventaris th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #inventaris tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Inventaris</h1>
    <div style="overflow-x: auto;">
        <table id="inventaris">
            <tr>
                <th>Nomor</th>
                <th>Kode Inventaris</th>
                <th>Nama Inventaris</th>
                <th>Merk Inventaris</th>
                <th>Jenis Inventaris</th>

                <th>Tanggal Operasional Inventaris</th>
                <th>Keterangan Inventaris</th>
                <th>Status Inventaris</th>

                <th>Tanggal Data Dibuat</th>

            </tr>


            @php
                $nomor = 1;
            @endphp

            @foreach ($inventaris_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>

                    <th scope="row">{{ $row->Kode_Inventaris }}</th>
                    <td>{{ $row->Nama_Inventaris }}</td>

                    @if ($row->Merk_Inventaris)
                        <td>{{ $row->Merk_Inventaris }}
                        </td>
                    @else
                        <td>-</td>
                    @endif

                    <td>{{ $row->Jenis_Inventaris }}</td>

                    <td>{{ $row->Tanggal_Operasional_Inventaris }}</td>
                    <td>{{ $row->Keterangan_Inventaris }}</td>
                    <td>{{ $row->Status_Inventaris }}</td>

                    <td>{{ $row->created_at->format('D,d M Y') }}</td>

                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
