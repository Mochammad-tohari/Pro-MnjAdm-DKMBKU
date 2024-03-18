<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #pengurus_nawa_data {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #pengurus_nawa_data th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #pengurus_nawa_data td,
        #pengurus_nawa_data th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #pengurus_nawa_data tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>


<body>

    <h1>Tabel Data Pengurus Nawa</h1>
    <div style="overflow-x: auto;">
        <table id="pengurus_nawa_data">

            <tr>
                <th>Nomor</th>
                <th>Kode Pengurus Nawa</th>
                <th>NIP Pengurus Nawa</th>
                <th>Jabatan Pengurus Nawa</th>
                <th>Nama Pengurus Nawa</th>
                <th>Kontak Pengurus Nawa</th>
                <th>Alamat Pengurus Nawa</th>

                <th>Keterangan Pengurus Nawa</th>
                <th>Status Pengurus Nawa</th>

                <th>Tanggal Data Dibuat</th>


            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($pengurus_nawa_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Pengurus_Nawa }}</th>

                    @if ($row->NIP_Pengurus_Nawa)
                        <th scope="row">{{ $row->NIP_Pengurus_Nawa }}</th>
                    @else
                        <td scope="row">Tidak Memiliki NIP</td>
                    @endif

                    {{-- memanggil dan mengecek kesediaan data kode_bidang_nawa
                                        yang ditampilkan oleh nama bidang_nawa dari table bidang_nawa --}}
                    @if ($row->ambil_kode_bidang_nawa)
                        <th scope="row">
                            {{ $row->ambil_kode_bidang_nawa->Nama_Bidang_Nawa }}
                        </th>
                    @else
                        <td scope="row">Jabatan Tidak Diketahui</td>
                    @endif

                    <td>{{ $row->Nama_Pengurus_Nawa }}</td>
                    <td>{{ $row->Kontak_Pengurus_Nawa }}</td>
                    <td>{{ $row->Alamat_Pengurus_Nawa }}</td>
                    <td>{{ $row->Keterangan_Pengurus_Nawa }}</td>
                    <td>{{ $row->Status_Pengurus_Nawa }}</td>

                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>

</body>

</html>
