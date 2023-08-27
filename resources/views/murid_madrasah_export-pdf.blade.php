<!DOCTYPE html>
<html>
<head>


<style type="text/css">


        #murid_madrasah {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 9pt;
        /*A4-sized pages in landscape orientation are 297 mm wide by 210 mm long*/
        size: 420mm 297mm;
        }

        #murid_madrasah th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }

        #murid_madrasah td, #murid_madrasah th {
        border: 1px solid #ddd;
        padding: 2px;
        }

        #murid_madrasah tr:nth-child(even){background-color: #ebebeb;}



	</style>


</head>
<body>

        <h1>Tabel Data Murid Madrasah</h1>
    <div style="overflow-x: auto;">
        <table id="murid_madrasah" style="table-layout: A3">
            <tr>
                <th style="col-auto">Nomor</th>
                <th style="col-auto">Kode Murid</th>
                <th scope="col">Nama Murid</th>
                <th scope="col">Tempat Lahir Murid</th>
                <th scope="col">Tanggal Lahir Murid</th>
                <th scope="col">Asal Sekolah Murid</th>
                <th scope="col">Nama Ayah Murid</th>
                <th scope="col">Nama Ibu Murid</th>
                <th scope="col">Nama Wali Murid</th>
                <th scope="col">Alamat Murid</th>
                <th scope="col">Tingkat Murid</th>
                <th scope="col">Keterangan Murid</th>
                <th scope="col">Status Murid</th>

                <th scope="col">Tanggal Data Dibuat</th>
            </tr>

        @php
            $nomor = 1;
        @endphp

        @foreach ($murid_madrasah_data as $row)

            <tr>

                <td>{{$nomor++}}</td>
                <th scope="row">{{$row->Kode_Murid}}</th>
                <td>{{$row->Nama_Murid}}</td>
                <td>{{$row->Tempat_Lahir_Murid}}</td>
                <td>{{$row->Tanggal_Lahir_Murid}}</td>
                <td>{{$row->Asal_Sekolah_Murid}}</td>
                <td>{{$row->Nama_Ayah_Murid}}</td>
                <td>{{$row->Nama_Ibu_Murid}}</td>
                <td>{{$row->Nama_Wali_Murid}}</td>
                <td>{{$row->Alamat_Murid}}</td>
                <td>{{$row->Tingkat_Murid}}</td>
                <td>{{$row->Keterangan_Murid}}</td>
                <td>{{$row->Status_Murid}}</td>

                <td>{{$row->created_at->format('D,d M Y')}}</td>
            </tr>


        @endforeach


        </table>
    </div>


</body>


</html>

