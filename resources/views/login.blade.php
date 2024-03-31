<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{ secure_asset('Tema_LTE/plugins/fontawesome-free/css/all.min.css') }} ">
    "secure_asset" untuk menjalankan di NGROK --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Tema_LTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('Tema_LTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Tema_LTE/dist/css/adminlte.min.css') }}">
    <!-- Dark Mode styles -->
    <link rel="stylesheet" href="{{ asset('public/Design/register&login.css') }}">

    <!-- Web Icon (Favicon) -->
    <link rel="icon" type="image/x-icon" href="Tema_LTE/dist/img/Logo_Masjid.png">

    <!-- Include SweetAlert and jQuery scripts -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }

        body {
            background-image: url('box_info_image/masjid_bg.jpg');
            /* Specify the path to your image */
            background-size: cover;
            background-position: center;

            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;

        }

        .wrapper {
            width: 380px;
            padding: 100px 50px;
            border: 0px solid rgba(6, 35, 57, 5);
            background: transparent;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 20px #24362fa8;
            border-radius: 20px;
        }

        .wrapper h1 {
            font-size: 40px;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }

        .email {
            width: 100%;
            border-bottom: 1px solid #a7a7a7;
            /* Underline border */
            margin-bottom: 20px;
            /* Add some spacing */
        }

        .email input[type="email"].form-control {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #ffffff;
            /* Text color */
        }

        .email input[type="email"].form-control::placeholder {
            color: #ffffff;
            /* Placeholder text color */
        }

        .password {
            width: 100%;
            border-bottom: 1px solid #a7a7a7;
            /* Underline border */
            margin-bottom: 20px;
            /* Add some spacing */
        }

        .password input[type="password"].form-control {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #ffffff;
            /* Text color */
        }

        .password input[type="password"].form-control::placeholder {
            color: #ffffff;
            /* Placeholder text color */
        }

        /* Styles for select element */
        .akses {
            width: 100%;
            border-bottom: 1px solid #a7a7a7;
            /* Underline border */
            margin-bottom: 20px;
            /* Add some spacing */
        }

        .akses select.custom-select {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #ffffff;
            /* Text color */
        }

        .akses select.custom-select option {
            background-color: #a0a0a0;
            /* Background color for options */
            color: #ffffff;
            /* Text color for options */
        }
    </style>

</head>

<body class="hold-transition login-page">

    <div class="wrapper">
        <form action="/login_user" method="POST">
            @csrf
            <h1>Manajemen DKMBKU</h1>

            <div class="email">
                <input type="email" class="form-control" placeholder="Email" name="email">
            </div>

            <div class="password">
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>

            <div class="akses">
                <select class="custom-select rounded-0" id="akses" name="akses">
                    <option disabled selected value="">Masuk Sebagai</option>
                    <option value="Admin">Admin</option>
                    <option value="Tamu">Tamu</option>
                </select>
            </div>

            <!-- /.col -->
            <div class="input-group mb-2">
                <button type="submit" class="btn btn-success btn-block">Masuk</button>
            </div>

            <div class="input-group mb-2">
                <a href="/register" class="btn btn-outline-info btn-block">Daftar</a>
            </div>

        </form>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('Tema_LTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Tema_LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Tema_LTE/dist/js/adminlte.min.js') }}"></script>
    <!-- memanggil script toastr cdn js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- memanggil script toastr cdn css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- Client-side validation using JavaScript --}}
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {

            const emailInput = document.querySelector('input[name="email"]');
            const passwordInput = document.querySelector('input[name="password"]');
            const selectedOption = document.getElementById('akses').value;

            if (emailInput.value.trim() === '' || passwordInput.value.trim() === '') {
                event.preventDefault();
                alert('Masukan Data Dengan Benar.');
            } else if (selectedOption === '') {
                event.preventDefault();
                alert('Mohon Pilih Akses Yang Sesuai.');
            }

        });
    </script>

    <!-- syntax pemberitahuan bahwa data telah dimasukan -->
    <script>
        @if (Session::has('success'))

            // Set a success toast, with a title
            toastr.success('Akun Sudah Dibuat', 'Berhasil');
        @endif
    </script>

    <!-- resources/views/auth/login.blade.php -->
    @if (session('success_login'))
        <script>
            $(document).ready(function() {
                swal("Success", "{{ session('success_login') }}", "success");
            });
        </script>
    @endif

    @if (session('error_login'))
        <script>
            $(document).ready(function() {
                swal("Error", "{{ session('error_login') }}", "error");
            });
        </script>
    @endif

</body>

</html>
