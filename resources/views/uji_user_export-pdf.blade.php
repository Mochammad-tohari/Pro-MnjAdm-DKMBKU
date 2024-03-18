<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #uji_user_data {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #uji_user_data th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #uji_user_data td,
        #uji_user_data th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #uji_user_data tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>

<body>

    <h1>Tabel Data Uji User</h1>
    <div style="overflow-x: auto;">
        <table id="uji_user_data">
            <tr>
                <th>Nomor</th>
                <th>Kode User</th>
                <th>Jabatan User</th>
                <th>Nama User</th>
                <th>Tanggal Daftar</th>
                <th>Keterangan User</th>
                <th>Status User</th>

                <th>Tanggal Data Dibuat</th>

            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($uji_user_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Uji_User }}</th>

                    {{-- memanggil dan mengecek kesediaan data kode_uji_bidang
                                        yang ditampilkan oleh nama Nama_Bidang dari table uji_bidang --}}
                    @if ($row->ambil_kode_uji_bidang)
                        <th scope="row">{{ $row->ambil_kode_uji_bidang->Nama_Bidang }}
                        </th>
                    @else
                        <td scope="row">Jabatan Tidak Diketahui</td>
                    @endif

                    <td>{{ $row->Nama_Uji_User }}</td>
                    <td>{{ $row->Tanggal_Uji_User }}</td>
                    <td>{{ $row->Keterangan_Uji_User }}</td>
                    <td>{{ $row->Status_Uji_User }}</td>

                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>


</body>


</html>
