<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('Tema_LTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('Tema_LTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('Tema_LTE/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1">Manajemen DKMBKU</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="/login_user" method="POST">
        @csrf

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
                <option disabled selected value="">Masuk Sebagai</option>
                <option value="Admin">Admin</option>
                <option value="Tamu">Tamu</option>
            </select>
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
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

    <!-- Submit Login -->

      <p class="mb-1">
        <a href="/register" class="text-center">Daftar Baru</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('Tema_LTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('Tema_LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('Tema_LTE/dist/js/adminlte.min.js') }}"></script>

{{-- Client-side validation using JavaScript --}}
<script>
    document.querySelector('form').addEventListener('submit', function(event) {

        const emailInput = document.querySelector('input[name="email"]');
        const passwordInput = document.querySelector('input[name="password"]');
        const selectedOption = document.getElementById('akses').value;

        if (emailInput.value.trim() === '' || passwordInput.value.trim() === '') {
            event.preventDefault();
            alert('Please enter both email and password.');
        } else if (selectedOption === '') {
            event.preventDefault();
            alert('Please select a valid role.');
        }

    });
</script>

</body>
</html>
