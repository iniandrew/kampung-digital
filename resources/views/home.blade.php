<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIKAT-APP</title>
    <link rel="icon" href="{{ Vite::asset('resources/images/icon.png') }}">
    @vite('resources/sass/app.scss')
  </head>
  <body>
    <div class="header">
      <nav class="navbar fixed-top navbar-expand-xl menu">
        <div class="container-fluid">
          <a class="navbar-brand nav-brand" href="#">
            <img src="{{ Vite::asset('resources/images/icon.png') }}" alt="" width="30" height="30" class="d-inline-block align-text-top img-icon">
            SIKAT
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link nav-menu" href="#about">Informasi Umum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-menu" href="#aduan">Aduan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-menu" href="#agenda">Agenda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-menu" href="#dana">Dana</a>
              </li>
              <li class="nav-item">
                <a class="nav-link nav-menu" href="#faq">FAQ</a>
              </li>
            </ul>
            <button type="button" class="btn-login"><a class="btn-href" href="#">Login</a></button>
          </div>
        </div>
      </nav>
    </div>
    <a href="#" type="button" id="btn-up" class="btn-up">
        <img src="{{ Vite::asset('resources/images/up.png') }}" alt="" width="30" class="img-up">
    </a>
    <div class="container">
      <section class="home" id="home">
        <div class="row row-home">
          <div class="col-xl-7" data-aos="fade-right" data-aos-duration="1500">
            <h1 class="title-home">SIKAT</h1>
            <p class="desc-home">Hi, Selamat Datang di Sistem Informasi Kampung Digital</p>
            <p class="desc-home-alt">Sebuah inovasi anak bangsa untuk kemajuan kampung, di era digital</p>
            <button type="button" class="btn-login"><a class="btn-href" href="#">Login</a></button>
          </div>
          <div class="col-xl-5" data-aos="fade-up" data-aos-duration="1500">
            <img class="img-home" src="{{ Vite::asset('resources/images/amico.png') }}" alt="">
          </div>
        </div>
      </section>
    </div>
    <section class="about" id="about">
      <br><br>
      <div class="container">
        <div class="row about-row">
          <div class="col-xl-6" data-aos="fade-up-right" data-aos-duration="1500">
            <h1 class="title-about">Apa itu SIKAT?</h1>
            <p class="desc-about">SIKAT (Sistem Informasi Kampung Digital) adalah aplikasi untuk membantu masyarakat  dalam pengembangan tempat tinggalnya. SIKAT (Sistem Informasi Kampung Digital) Mempunyai beberapa fitur yaitu:</p>
            <div class="fitur-menu">
              <p class="fitur-item"><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur"> Aduan Warga</p>
              <p class="fitur-item"><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur"> Agenda Desa</p>
              <p class="fitur-item"><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur"> Dana Desa</p>
            </div>
          </div>
          <div class="col-xl-6">
            <img src="{{ Vite::asset('resources/images/amico2.png') }}" alt="" class="img-about">
          </div>
        </div>
        <div class="row benefit-row">
          <div class="col-xl-6" data-aos="flip-left" data-aos-duration="1500">
            <img src="{{ Vite::asset('resources/images/bro.png') }}" alt="" class="img-about" width="530">
          </div>
          <div class="col-xl-6">
            <h1 class="title-about">Apa manfaat SIKAT?</h1>
            <p class="desc-about">SIKAT (Sistem Informasi Kampung Digital) dibuat berdasarkan kebutuhan masyarakat, dengan adanya SIKAT masyarakat dapat memanfaatkan fitur-fitur yang ada di SIKAT</p>
            <div class="fitur-menu">
              <p class="fitur-item"><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur-benefit"> Mudah digunakan</p>
              <p class="fitur-item"><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur-benefit"> Akses informasi lebih cepat</p>
              <p class="fitur-item"><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur-benefit"> Memudahkan masyarakat untuk melihat data aliran dana desa</p>
              <p class="fitur-item"><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur-benefit"> Manajemen lebih terkontrol</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="aduan" id="aduan">
      <div class="container aduan">
        <div class="row">
          <div class="col-xl-6">
            <div class="container">
              <h1 class="title-aduan">Aduan Warga</h1>
              <div class="desc-aduan">
                Aduan Warga dapat digunakan secara mandiri oleh warga desa untuk menyampaikan keluhan dan aspirasinya. Dengan semakin terbukanya ruang informasi, maka pola komunikasi dua arah antara perangkat desa dan masyarakat harus tersusun melalui sebuah sistem yang baik. Hal ini dilakukan untuk meminimalisir gesekan akibat perbedaan pemahaman atas informasi yang tersampaikan.
              </div>
            </div>
          </div>
          <div class="col-xl-6" data-aos="flip-down" data-aos-duration="1500">
            <img src="{{ Vite::asset('resources/images/Feedback-amico.png') }}" width="500" alt="" class="img-aduan">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6">
            <h1 class="title-aduan-alt">Syarat Aduan yang ditanggapi</h1>
             <div class="fitur-menu">
               <p><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur-benefit"><span class="rule-aduan"> Identitas Warga Desa Jelas</span></p>
               <p><img src="{{ Vite::asset('resources/images/checklist.png') }}" alt="" class="img-fitur-benefit"><span class="rule-aduan"> Menyertakan bukti yang mendukung Pengaduan yang disampaikan</span></p>
            </div>
          </div>
          <div class="col-xl-6">
            <h1 class="title-aduan-alt">Manfaat Aduan Warga</h1>
            <div class="desc-benefit-aduan">Aduan Warga bermanfaat untuk memudahkan masyarakat sehingga masyarakat tidak perlu menunggu perangkat desa. Masyarakat cukup melakukan laporan aduan pada website SIKAT agar dapat menyalurkan aspirasi serta keluhan pada perangkat desa setempat.</div>
          </div>
        </div>
      </div>
    </section>
    <section class="agenda" id="agenda">
      <div class="container agenda">
        <div class="row">
          <div class="col-xl-6">
            <h1 class="title-agenda">Agenda Desa</h1>
            <div class="desc-agenda">
              Agenda Desa dapat digunakan  untuk melihat jadwal Agenda Desa. Warga Desa tidak perlu lagi untuk bertanya kepada perangkat desa tentang kegiatan apa yang akan diadakan di desa. Warga Desa bisa langsung melihat Agenda Desa di website SIKAT
            </div>
            <h1 class="title-agenda">Manfaat Agenda Desa</h1>
            <div class="desc-agenda">
              Agenda Desa bermanfaat untuk masyarakat tidak perlu menunggu perangkat desa. Masyarakat cukup melakukan laporan aduan pada website SIKAT agar dapat menyalurkan aspirasi serta keluhan pada perangkat desa setempat.
            </div>
          </div>
          <div class="col-xl-6" data-aos="zoom-in-up" data-aos-duration="1500">
            <img src="{{ Vite::asset('resources/images/Schedule-amico.png') }}" width="530" alt="" class="img-agenda">
          </div>
        </div>
      </div>
    </section>
    <section class="dana" id="dana">
      <div class="container dana">
        <div class="row">
          <div class="col-xl-6" data-aos="zoom-in-right" data-aos-duration="1500">
            <img src="{{ Vite::asset('resources/images/Spreadsheets-pana.png') }}" width="530" alt="" class="img-dana">
          </div>
          <div class="col-xl-6">
            <h1 class="title-dana">Dana Desa</h1>
             <div class="desc-dana">
              Dana Desa adalah fitur yang digunakan untuk melihat data transparansi pengelolaan desa.
            </div>
            <h1 class="title-dana-alt">Manfaat Dana Desa</h1>
             <div class="desc-dana">
             Dengan adanya fitur melihat aliran dana desa, diharapkan terciptanya transparansi pengelolaan desa yang sehat, dan masyarakat tak perlu khawatir terhadap pengelolaan desa yang semena-mena. Warga juga dapat melihat transparansi pengelolaan desa tanpa perlu lagi menggunakan metode yang manual.
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="faq" id="faq">
      <br><br>
      <div class="faq-content">
        <h1 class="title-faq">Frequently asked questions</h1>
        <center>
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                 Apa keuntungan menggunakan SIKAT?
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <p class="text-faq">Dengan bergabung bersama SIKAT maka segala urusan Aduan Warga, Agenda Desa, dan Aliran Dana Desa,  dapat diakses dengan mudah oleh perangkat desa maupun warga desa.</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  Bagaimana cara menulis aduan?
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <p class="text-faq">Silahkan mengisi formulir untuk pengaduan anda, sematkan bukti aduan untuk mendukung aduan anda segera diproses</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  Apakah ada syarat khusus untuk menggunakan layanan website ini?
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <p class="text-faq">Syarat untuk dapat menggunakan layanan ini anda harus terdaftar sebagai warga kampung yang didata oleh ketua RW setempat</p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">
                  Bagaimana cara daftar akun di SIKAT?
                </button>
              </h2>
              <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <p class="text-faq">Segera lapor ke ketua RW setempat agar anda segera dibuatkan akun untuk dapat menggakses website SIKAT dan merasakan mafaatnya</p>
                </div>
              </div>
            </div>
          </div>
        </center>
      </div>
    </section>
    <section class="footer">
      <div class="container">
        <br><br><br>
        <center>
          <img src="{{ Vite::asset('resources/images/icon.png') }}" alt="" class="img-footer"> <span class="title-footer">SIKAT</span>
          <br><br><span class="end-footer">&copy; 2022 SIKAT. All rights reserved.</span>
          <br><br><br>
        </center>
      </div>
    </section>
    @vite('resources/js/app.js')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
