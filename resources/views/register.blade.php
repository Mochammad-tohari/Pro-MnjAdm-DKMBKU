<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar User</title>

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
            width: 400px;
            padding: 80px 20px;
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

        .name,
        .email,
        .password,
        .akses {
            width: 100%;
            border-bottom: 1px solid #a7a7a7;
            /* Underline border */
            margin-bottom: 20px;
            /* Add some spacing */
        }

        .name input[type="text"].form-control,
        .email input[type="email"].form-control,
        .password input[type="password"].form-control {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #ffffff;
            /* Text color */
        }

        .name input[type="text"].form-control::placeholder,
        .email input[type="email"].form-control::placeholder,
        .password input[type="password"].form-control::placeholder {
            color: #ffffff;
            /* Placeholder text color */
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

        .modal {
            z-index: 1050;
            /* Adjust the z-index as needed */
        }
    </style>


</head>

<body class="hold-transition register-page">

    <div class="wrapper">
        <form action="/register_user" method="post">
            @csrf
            <h1>Daftar Manajemen DKMBKU</h1>

            <div class="name">
                <input type="text" class="form-control" placeholder="Username" name="name" id="name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="email">
                <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                    value="{{ old('email') }}">
                @if ($errors->has('email'))
                    @if ($errors->first('email') == 'The email field is required.')
                        <div class="alert alert-danger">Email harus diisi</div>
                    @else
                        <div class="alert alert-danger">Email sudah digunakan. Silahkan gunakan email lain.
                        </div>
                    @endif
                @endif
            </div>

            <div class="password">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="akses">
                <select class="custom-select rounded-0" id="akses" name="akses">
                    <option selected disabled>Daftar Sebagai</option>
                    <option value="Admin">Admin</option>
                    <option value="Tamu">Tamu</option>
                </select>
            </div>



            <!-- /.col -->
            <div class="input-group mb-2">
                <button type="submit" class="btn btn-success btn-block" id="submitBtn" disabled>Daftar</button>
            </div>

            <div class="input-group mb-2">
                <a href="/login" class="btn btn-outline-info btn-block">←
                    Kembali</a>
            </div>

        </form>
    </div>

    {{-- modal process --}}

    <div class="modal fade" id="passcodeModal" tabindex="-1" role="dialog" aria-labelledby="passcodeModalLabel"
        aria-hidden="true" name="passcodeModal" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passcodeModalLabel">Masukan Admin Passcode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        id="closePasscodeModal"><span aria-hidden="true">&times;
                        </span></button>
                </div>
                <div class="modal-body">
                    <input type="password" class="form-control" placeholder="Passcode" id="passcodeInput">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="closeModalButton">Tutup</button><button type="button" class="btn btn-primary"
                        id="checkPasscodeBtn">Check
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- end modal --}}

    {{-- < !-- jQuery --> --}}
    <script src="{{ asset('Tema_LTE/plugins/jquery/jquery.min.js') }}"></script>
    {{-- < !-- Bootstrap 4 --> --}}
    <script src="{{ asset('Tema_LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- < !-- AdminLTE App --> --}}
    <script src="{{ asset('Tema_LTE/dist/js/adminlte.min.js') }}"></script>
    {{-- < !-- syntax passcode--> --}}
    <script src="{{ asset('DKM/passcode-validation.js') }}"></script>


</body>

</html>
