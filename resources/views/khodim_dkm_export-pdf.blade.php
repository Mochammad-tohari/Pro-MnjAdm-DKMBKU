<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #khodim_dkm {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 420mm 297mm;
        }

        #khodim_dkm th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #khodim_dkm td,
        #khodim_dkm th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #khodim_dkm tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Khodim DKM</h1>
    <div style="overflow-x: auto;">
        <table id="khodim_dkm">
            <tr>
                <th>Nomor</th>

                <th>Kode Khodim</th>
                <th>Jabatan Khodim</th>
                <th>Nama Khodim</th>
                <th>Kontak Khodim</th>
                <th>Alamat Khodim</th>
                <th>Keterangan Khodim</th>
                <th>Status Khodim</th>

                <th>Tanggal Data Dibuat</th>
            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($khodim_dkm_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>

                    <th scope="row">{{ $row->Kode_Khodim }}</th>
                    <td>{{ $row->ambil_kode_bidang_khodim->Nama_Bidang_Khodim }}</td>
                    <td>{{ $row->Nama_Khodim }}</td>
                    <td>{{ $row->Kontak_Khodim }}</td>
                    <td>{{ $row->Alamat_Khodim }}</td>
                    <td>{{ $row->Keterangan_Khodim }}</td>
                    <td>{{ $row->Status_Khodim }}</td>

                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
