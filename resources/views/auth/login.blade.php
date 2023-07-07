<!doctype html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
      <title>Login</title>

      <link rel="icon" href="{{ asset('img/icon.png') }}">

      @vite([
        "resources/assets/modules/bootstrap/css/bootstrap.min.css",
        "resources/assets/modules/fontawesome/css/all.min.css",
        "resources/assets/css/style.css",
        "resources/assets/css/components.css"
      ])
      <!-- Start GA -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  </head>
  <body>
    <div id="app">
      <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
              <div class="login-brand">
                <img src="{{ Vite::asset('resources/images/login.png') }}" alt="logo" width="100">
              </div>

              <div class="card card-primary">
                <div class="card-header">
                    <a href="{{ route('home') }}" title="Kembali"><img src="{{ Vite::asset('resources/images/back.png') }}" alt=""></a>&nbsp;&nbsp;<h4 style="font-weight: 700; font-size: 24px; color: #064E3B">SIKAT - Login</h4>
                </div>

                <div class="card-body">
                  <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control @error("email") is-invalid @enderror" placeholder="Masukkan Email" value="{{ old('email') }}" name="email" tabindex="1" required autofocus>
                      @error('email')
                          <div class="invalid-feedback">
                            E-mail anda tidak dikenal
                        </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                      <input id="password" type="password" class="form-control @error("password") is-invalid @enderror" placeholder="Masukkan Password" name="password" tabindex="2" required>
                      @error('password')
                            <div class="invalid-feedback">
                                Password anda tidak dikenal
                            </div>
                      @enderror
                    </div>
                    <div class="form-group mt-4">
                      <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                      </button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
      @vite([
        "resources/assets/modules/jquery.min.js",
        "resources/assets/modules/popper.js",
        "resources/assets/modules/tooltip.js",
        "resources/assets/modules/bootstrap/js/bootstrap.min.js",
        "resources/assets/modules/nicescroll/jquery.nicescroll.min.js",
        "resources/assets/modules/moment.min.js",
        "resources/assets/js/stisla.js",
        "resources/assets/js/custom.js",
      ])
  </body>
</html>
