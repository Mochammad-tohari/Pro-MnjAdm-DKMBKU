<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar User</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset ('Tema_LTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset ('Tema_LTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('Tema_LTE/dist/css/adminlte.min.css') }}">
  <!-- Dark Mode styles -->
  <link rel="stylesheet" href="{{ asset ('public/Design/register&login.css') }}">

  <!-- Web Icon (Favicon) -->
  <link rel="icon" type="image/x-icon" href="Tema_LTE/dist/img/Logo_Masjid.png">
</head>

<body class="hold-transition login-page dark-mode">
<div class="login-box">
  <!-- /.register -logo -->
  <div class="card card-outline card-success">
    <div class="card-header text-center col-auto">
      <a href="#" class="h1">Manajemen
        <p>DKMBKU</p>
      </a>
    </div>
    <div class="card-body col-auto">
      <p class="login-box-msg">Daftar Akun</p>

      <form action="/register_user" method="post">
        @csrf

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <select class="custom-select rounded-0" id="akses" name="akses">
                <option selected disabled>Daftar Sebagai</option>
                <option value="Admin">Admin</option>
                <option value="Tamu">Tamu</option>
            </select>
          </div>

          {{-- modal passcode --}}
          <div class="modal fade" id="passcodeModal" tabindex="-1" role="dialog" aria-labelledby="passcodeModalLabel" aria-hidden="true" name="passcodeModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passcodeModalLabel">Masukan Admin Passcode</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closePasscodeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="password" class="form-control" placeholder="Passcode" id="passcodeInput">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalButton">Close</button>
                        <button type="button" class="btn btn-primary" id="checkPasscodeBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>

          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>

            <!-- /.col -->
            <div class="input-group mb-3">
                <button type="submit" class="btn btn-success btn-block" id="submitBtn" disabled>Daftar</button>
            </div>

            <div class="input-group mb-3">
                <a href="/login" class="btn btn-primary btn-block">Masuk</a>
            </div>

            <!-- /.col -->
          </div>
        </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.register-box -->

<!-- Example Dark Mode Toggle Button -->
{{-- <button type="button" class="btn btn-outline-light" id="darkModeToggle">Tema</button> --}}


<!-- ... Rest of the code ... -->


<!-- jQuery -->
<script src="{{ asset ('Tema_LTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('Tema_LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('Tema_LTE/dist/js/adminlte.min.js') }}"></script>
<!-- syntax passcode-->
<script src="{{ asset('DKM/passcode-validation.js') }}"></script>

<script>
    document.getElementById('darkModeToggle').addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
    });
</script>


</body>
</html>
