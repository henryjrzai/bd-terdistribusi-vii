<?php
require('mongodb_connection.php');
$jdmatkul = $database->jadwalkuliah->find();
$mahasiswa = $database->mahasiswa->find();
$matkul = $database->matakuliah->find();
$dsn = $database->dosen->find();

$colMhs = $database->mahasiswa;
$dataMhs = $colMhs->find();

$colDsn = $database->dosen;
$dataDsn = $colDsn->find();

$colMatkul = $database->matakuliah;
$dataMatkul = $colMatkul->find();

// Menghitung total data mahasiswa
$total_mahasiswa = iterator_count($mahasiswa);

// Menghitung total data dosen
$total_dosen = iterator_count($dsn);

// Menghitung total data mata kuliah
$total_makul = iterator_count($matkul);

// Menghitung total data jadwal kuliah
$total_jadwal = iterator_count($jdmatkul);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Aplikasi Akademik</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/assets/img/favicon.png" rel="icon">
  <link href="assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    #hero-row {
      margin-top: -100px;
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Akademik</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>

        </ul>
        <i class="mobile-nav-toggle d-xl-none "></i>
      </nav>

      <a class="btn-getstarted" href="admin/index.php">Dashboard</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container">
        <div class="row gy-4" id="hero-row">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
            <h1>Aplikasi Jadwal Perkuliahan</h1>
            <p>Solusi Terbaik untuk Mengatur Jadwal Kuliah</p>
            <div class="d-flex">
              <a href="admin/index.php" class="btn-get-started">Masuk Dashboard</a>
              <a href="#stats" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Lihat Detail</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
            <img src="assets/assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->


    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_mahasiswa ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Mahasiswa</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_dosen; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Dosen</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_makul; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Matakuliah</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $total_jadwal; ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Jadwal Kuliah</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Dosen</span>
        <h2>Data Dosen</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="table-responsive">
            <table id="myTable" class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>No</td>
                  <td>NIDN</td>
                  <td>Nama</td>
                  <td>Jurusan</td>
                  <td>Email</td>
                  <td>No Hp</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($dataDsn as $dosen) {
                  echo '<tr>';
                  echo '<td>' . $no++ . '</td>';
                  echo '<td>' . $dosen['nidn'] . '</td>';
                  echo '<td>' . $dosen['nama'] . '</td>';
                  echo '<td>' . $dosen['jurusan'] . '</td>';
                  echo '<td>' . $dosen['email'] . '</td>';
                  echo '<td>' . $dosen['no_hp'] . '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Mahasiswa</span>
        <h2>Data Mahasiswa</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <td>#</td>
                  <td>Nim</td>
                  <td>Nama</td>
                  <td>Jurusan</td>
                  <td>Alamat</td>
                  <td>Email</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($dataMhs as $m) {
                  echo '<tr>';
                  echo '<td>' . $no++ . '</td>';
                  echo '<td>' . $m['nim'] . '</td>';
                  echo '<td>' . $m['nama'] . '</td>';
                  echo '<td>' . $m['jurusan'] . '</td>';
                  echo '<td>' . $m['alamat'] . '</td>';
                  echo '<td>' . $m['email'] . '</td>';
                  echo '</tr>';
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Matakuliah</span>
        <h2>Data Matakuliah</h2>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <table id="myTable" class="table table-striped table-hover">
          <thead>
            <tr>
              <td>No</td>
              <td>Kode Matkul</td>
              <td>Nama Matkul</td>
              <td>SKS</td>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($dataMatkul as $matkul) {
              echo '<tr>';
              echo '<td>' . $no++ . '</td>';
              echo '<td>' . $matkul['kode_mk'] . '</td>';
              echo '<td>' . $matkul['nama_mk'] . '</td>';
              echo '<td>' . $matkul['sks'] . '</td>';
            }
            ?>
          </tbody>
        </table>

      </div>

    </section><!-- /Testimonials Section -->

    
    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Our Developer</span>
        <h2>Team</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="pic"><img src="assets/assets/img/team/team-1.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Henry Junior Zai</h4>
                <span>Computer Science Faculty</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <div class="pic"><img src="assets/assets/img/team/team-2.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Elsa Desriyani Sijabat</h4>
                <span>Computer Science Faculty</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="pic"><img src="assets/assets/img/team/team-3.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Agus Yunus Sihombing</h4>
                <span>Computer Science Faculty</span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

  </main>

  <footer id="footer" class="footer">

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Akademik UST</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Matakuliah <a href="#">Basis Data Terdistribusi</a> 2025
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/assets/vendor/aos/aos.js"></script>
  <script src="assets/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/assets/js/main.js"></script>

</body>

</html>