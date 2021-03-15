<!doctype html>

<html lang="en">

<?php $this->load->view('_partials/head'); ?>

<body>
    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <?php $this->load->view('_partials/sidebar'); ?>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="toggled">
            <div id="content">
                <div class="container-fluid p-0 px-lg-0 px-md-0">

                    <!-- Navbar -->
                    <?php $this->load->view('_partials/navbar'); ?>

                    <!-- Begin Page Content -->
                    <div class="container-fluid px-lg-4">
                        <div class="row">
                            <div class="col-md-12 mt-lg-4 mt-4">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">ANOVA</h1>
                                </div>
                                <div class="col-md-12 mt-4" id="mainContainer">
                                    <div class="card">
                                        <h5>
                                            ANOVA (analysis of variance) adalah suatu metode analisis statistika yang digunakan untuk menguji perbedaan mean (rata-rata) data lebih dari dua kelompok.
                                            Disebut ANOVA karena pengujian dilakukan dengan membandingkan varians, sehingga dapat diketahui ada tidaknya perbedaan rata-rata dari tiga atau lebih kelompok.
                                        </h5>
                                        <h5>
                                            Asumsi-asumsi yang harus dipenuhi sebelum melakukan ANOVA sebagai berikut
                                            <ol>
                                                <li>Data berdistribusi normal</li>
                                                <li>Varians atau ragamnya homogen</li>
                                                <li>Masing-masing sampel saling bebas</li>
                                            </ol>
                                        </h5>
                                        <h5>
                                            Terdapat 2 jenis ANOVA.
                                            <ol>
                                                <li>One Way ANOVA</li>
                                                <li>Two Way ANOVA</li>
                                            </ol>
                                            Silahkan klik tombol salah satu jenis ANOVA untuk memulai menghitung.
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex justify-content-left">
                                                        <button class="btn btn-secondary ml-3 mb-2" onclick="oneway();">One Way ANOVA</button>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="">
                                                        <button class="btn btn-secondary ml-3 mb-2" onclick="twoway();">Two Way ANOVA</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <?php $this->load->view('_partials/footer'); ?>

            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $('#bar').click(function() {
            $(this).toggleClass('open');
            $('#page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled');

        });
    </script>
    <?php $this->load->view('js/anovaoneway'); ?>
    <?php $this->load->view('js/anovatwoway'); ?>
</body>

</html>