<!DOCTYPE html>
<html>

<head>


    <style type="text/css">
        #pengurus_dkm_data {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 9pt;
            /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
            size: 297mm 210mm;
        }

        #pengurus_dkm_data th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        #pengurus_dkm_data td,
        #pengurus_dkm_data th {
            border: 1px solid #ddd;
            padding: 2px;
        }

        #pengurus_dkm_data tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>


</head>


<body>

    <h1>Tabel Data Pengurus DKM</h1>
    <div style="overflow-x: auto;">
        <table id="pengurus_dkm_data">

            <tr>
                <th>Nomor</th>
                <th>Kode Pengurus DKM</th>
                <th>NIP Pengurus DKM</th>
                <th>Jabatan Pengurus DKM</th>
                <th>Nama Pengurus DKM</th>
                <th>Kontak Pengurus DKM</th>
                <th>Alamat Pengurus DKM</th>

                <th>Keterangan Pengurus DKM</th>
                <th>Status Pengurus DKM</th>

                <th>Tanggal Data Dibuat</th>


            </tr>

            @php
                $nomor = 1;
            @endphp

            @foreach ($pengurus_dkm_data as $row)
                <tr>

                    <td>{{ $nomor++ }}</td>
                    <th scope="row">{{ $row->Kode_Pengurus_DKM }}</th>

                    @if ($row->NIP_Pengurus_DKM)
                        <th scope="row">
                            {{ $row->NIP_Pengurus_DKM }}
                        </th>
                    @else
                        <td scope="row">Tidak Memiliki NIP</td>
                    @endif

                    {{-- memanggil dan mengecek kesediaan data kode_bidang_pengurus
                                        yang ditampilkan oleh nama bidang_pengurus dari table bidang_pengurus --}}
                    @if ($row->ambil_kode_bidang_pengurus)
                        <th scope="row">
                            {{ $row->ambil_kode_bidang_pengurus->Nama_Bidang_Pengurus_DKM }}
                        </th>
                    @else
                        <td scope="row">Jabatan Tidak Diketahui</td>
                    @endif

                    <td>{{ $row->Nama_Pengurus_DKM }}</td>
                    <td>{{ $row->Kontak_Pengurus_DKM }}</td>
                    <td>{{ $row->Alamat_Pengurus_DKM }}</td>
                    <td>{{ $row->Keterangan_Pengurus_DKM }}</td>
                    <td>{{ $row->Status_Pengurus_DKM }}</td>

                    <td>{{ $row->created_at->format('D,d M Y') }}</td>
                </tr>
            @endforeach


        </table>
    </div>

</body>

</html>
