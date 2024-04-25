<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #majlistalim {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #majlistalim th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #majlistalim td,
        #majlistalim th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #majlistalim tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Majlistalim</h1>
    <div style="overflow-x: auto;">
        <table id="majlistalim">
            <tr>
                <th>Nomor</th>
                <th>Kode Majlistalim</th>
                <th>Nama Majlistalim</th>
                <th>Penanggung Jawab Majlistalim</th>
                <th>Kontak Majlistalim</th>


                <th>Keterangan Majlistalim</th>
                <th>Status Majlistalim</th>

                <th>Tanggal Data Dibuat</th>

            </tr>


            @php
                $nomor = 1;
            @endphp

            @foreach ($majlistalim_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>

                    <th scope="row">{{ $row->Kode_Majlistalim }}</th>
                    <td>{{ $row->Nama_Majlistalim }}</td>

                    @if ($row->Penanggung_Jawab_Majlistalim)
                        <td>{{ $row->Penanggung_Jawab_Majlistalim }}
                        </td>
                    @else
                        <td>-</td>
                    @endif

                    <td>{{ $row->Kontak_Majlistalim }}</td>
                    <td>{{ $row->Keterangan_Majlistalim }}</td>
                    <td>{{ $row->Status_Majlistalim }}</td>

                    <td>{{ $row->created_at->format('D,d M Y') }}</td>

                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
